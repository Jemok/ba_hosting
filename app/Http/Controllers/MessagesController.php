<?php

/**
 * Manages the messaging app workflow
 */
namespace Md\Http\Controllers;

use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Md\Http\Requests\MessagesCreateRequest;
use Md\Http\Requests\MessagesRequest;
use Md\Innovation;
use Md\Services\PusherWrapper as Pusher;
use Md\User;
use Md\Progress;

class MessagesController extends Controller
{
    /**
     * @var Pusher
     */
    protected $pusher;

    /**
     * @param Pusher $pusher
     */
    public function __construct(Pusher $pusher)
    {
        $this->pusher = $pusher;
    }

    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
        $currentUserId = Auth::user()->id;

        // All threads that user is participating in
        $threads = Thread::forUser($currentUserId)->get();

        return view('messenger.index', compact('threads', 'currentUserId'));
    }

    /**
     * Get the first message in a conversation
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function first($id)
    {
        $thread = Thread::where('innovation_id', '=', $id)->first();

        $message = Thread::where('id', '=', $id)
                ->where('user_id', '=', \Auth::user()->id)
                ->with('messages')->first();

        return view('partials.messenger.innovation_messages', compact('message', 'thread'));
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect('messages');
        }

        // don't show the current user in list
        $userId = Auth::user()->id;
        $users = User::whereNotIn('id', $thread->participantsUserIds($userId))->get();

        $thread->markAsRead($userId);

        return view('messenger.show', compact('thread', 'users'));
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    public function showMessage($id)
    {
        $thread = Thread::find($id);
        $message = Message::where('thread_id', '=', $id)->orderBy('created_at', 'desc')->first();

        return view('messenger.html-message', compact('thread','message'));
    }


    /**
     * @param $innovation_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createExpert($innovation_id)
    {
        $users = User::where('userCategory', '=', 3)
            ->where('id', '!=', Auth::id())->get();

        return view('messenger.with_subject', compact('users', 'innovation_id'));
    }

    /**
     * Creates a conversation with an ivestor
     * @param $innovation_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createInvestor($innovation_id)
    {
        $users = User::where('userCategory', '=', 2)
            ->where('id', '!=', Auth::id())->get();

        return view('messenger.with_subject', compact('users', 'innovation_id'));
    }

    /**
     * Creates a new message thread.
     *
     * @return mixedi0
     *
     * .
     */
    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();

        return view('messenger.create', compact('users'));
    }

    /**
     * Creates a conversation thread with mother
     * @param $innovation_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createMother($innovation_id)
    {
        $users = User::where('id', '=', 1)->get();

        return view('messenger.with_subject', compact('users', 'innovation_id'));
    }

    /**
     * Persists a message to the database
     * @param MessagesCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MessagesCreateRequest $request)
    {
        $input = $request;
        $innovation = Innovation::findOrFail($input['innovation_id']);

        $thread = Thread::create(

            [
                'subject' => $input['subject'],
                'innovation_id' => $input['innovation_id'],
                'user_id' => \Auth::user()->id,
                'receiver_id' => $innovation->user_id,
                'unique_id'   => str_random(30)

            ]
        );

        $this->addReceiver($thread, $input['recipients']);

        // Message
        $message = Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => $input['message'],
                'starter_id' => \Auth::user()->id,
                'innovation_id' => $input['innovation_id']
            ]
        );

        if (Input::has('progress')) {
            Progress::create([

                'innovation_id' => $input['innovation_id'],
                'investor_id'   => Auth::user()->id,
                'progress_status' => 1

            ]);
        }

        // Sender
        Participant::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'last_read' => new Carbon,
            ]
        );

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipants($input['recipients']);
        }

        $this->oooPushIt($message);

        return redirect('innovation/'.$innovation->id.'#messages');
    }

    /**
     * Add the threads receiver
     * @param Thread $thread
     * @param array $participants
     */
    public function addReceiver(Thread $thread, array $participants)
    {
        if (count($participants)) {
            foreach ($participants as $user_id) {
                $thread->update([
                    'receiver_id' => $user_id,
                ]);
            }
        }
    }

    /**
     * Update a thread
     * @param $id
     * @param MessagesRequest $request
     * @param $unique_id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, MessagesRequest $request, $unique_id)
    {
        $input = $request;

        try {
            $thread = Thread::where('innovation_id', '=', $id)
                      ->where('unique_id', '=', $unique_id)
                      ->first();

        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect('messages');
        }

        $thread->activateAllParticipants();

        // Message
        $message = Message::create(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
                'body'      => htmlentities($input->message)
            ]
        );

        // Add replier as a participant
        $participant = Participant::firstOrCreate(
            [
                'thread_id' => $thread->id,
                'user_id'   => Auth::user()->id,
            ]
        );

        $participant->last_read = new Carbon;
        $participant->save();

        // Recipients
        if (Input::has('recipients')) {
            $thread->addParticipants(Input::get('recipients'));
        }

        $this->oooPushIt($message);

        return response()->json(['id' => $message->id]);
    }

    /**
     * Send the new message to Pusher in order to notify users.
     *
     * @param Message $message
     */
    protected function oooPushIt(Message $message)
    {
        $thread = $message->thread;
        $sender = $message->user;

        $data = [
            'thread_id' => $thread->id,
            'div_id' => 'thread_'.$thread->id,
            'sender_name' => $sender->first_name,
            'thread_url' => route('messages.show', ['id' => $thread->id]),
            'thread_subject' => $thread->subject,
            'html' => view('messenger.html-message', compact('thread','message'))->render(),
            'text' => str_limit($message->body, 50),
        ];

        $recipients = $thread->participantsUserIds();
        if (count($recipients) > 0) {
            foreach ($recipients as $recipient) {
                if ($recipient == $sender->id) {
                    continue;
                }

                $this->pusher->trigger('for_user_' . $recipient, 'new_message', $data);
            }
        }
    }

    /**
     * Mark a specific thread as read, for ajax use.
     *
     * @param $id
     */
    public function read($id)
    {
        $thread = Thread::find($id);
        if (!$thread) {
            abort(404);
        }

        $thread->markAsRead(Auth::id());
    }

    /**
     * Get the number of unread threads, for ajax use.
     *
     * @return array
     */
    public function unread()
    {
        $count = Auth::user()->newMessagesCount();

        return ['msg_count' => $count];
    }
}
