<?php namespace Md\Http\Controllers;

use Md\Chat;
use Md\Http\Requests;
use Md\Http\Controllers\Controller;
use Md\Message;
use Illuminate\Http\Request;

use Md\Repos\Conversation\ConversationRepository;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public $id;

    public function index()
    {


        $chats = Chat::where('innovator_id', '=', \Auth::user()->id)
                       ->orWhere('investor_id', '=', \Auth::user()->id);

        $data = [
           'chats'   => $chats
        ];

        return view('item.index', $data);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {
        $chat = new Chat;

        if
        (
            $chat->where('innovation_id', '=', $request->innovation_id)
                ->where('investor_id', '=', \Auth::user()->id)
                ->orWhere('innovator_id', '=', \Auth::user()->id)->first() == null
        )
        {
            $item = new Chat;
            $item->innovation_id = $request->innovation_id;
            $item->investor_id = \Auth::user()->id;
            $item->innovator_id = \Md\Innovation::where('id', '=', $request->innovation_id)->first()->user_id;

            $item->save();

            $innovation_id = $item->where('innovation_id', '=', $request->innovation_id)
                ->where('investor_id', '=', \Auth::user()->id)->first()->id;

            $message = new Message;

            $message->create([
                'title' => $request->title,
                'sender_id' => \Auth::user()->id,
                'chat_id' => $innovation_id
            ]);

            return response()->json(['id' => $message->id]);
        }
        else
        {
            $chat = new Chat;

            $chat = $chat->where('innovation_id', '=', $request->innovation_id)
                ->where('investor_id', '=', \Auth::user()->id)
                ->orWhere('innovator_id', '=', \Auth::user()->id)->first();

            $message = $chat->messages()->create([

                'title' => $request->title,
                'sender_id' => \Auth::user()->id,

            ]);

            return response()->json(['id' => $message->id]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $message = Message::find($id);
        return view('item.show', ['message' => $message]);
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id)
    {
        $item = Chat::find($id);
        $item->isCompleted = (bool) $request->isCompleted;
        $item->save();
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $item = Chat::find($id);
        $item->delete();
        return;
    }
}
