<?php namespace Md\Repos\Conversation;

/**
 * Code not used
 */


use Md\Chat;
use Md\Innovation;
use Md\Message;
use Md\Progress;

class ConversationRepository {

    public function startConversation($request, $innovation)
    {
        $chat = Chat::create([
            'investor_id' => \Auth::user()->id,
            'innovation_id' => $innovation,
            'start_message' => $request->start_message
        ]);

        return $chat;
    }

    public function storeComment($message, Chat $chat)
    {
        return $chat->comments()->create([
            'message' => $message
        ]);
    }

    public function retrieveChats($id)
    {

        return Chat::where('innovation_id', '=', $id)->with('messages')->get();
    }

    public function retrieveCommentsOf(Chat $chat)
    {
        return $chat->comments()->get();
    }

    public function chatExists($id)
    {
       if(Chat::where('innovation_id', '=', $id)->where('investor_id', '=', \Auth::user()->id)->first() == null)
       {
           return 1;
       }
        else
        {
            return 2;
        }
    }

    public function checkChatWithInnovator($id)
    {
        if (Progress::where('investor_id', '=', \Auth::user()->id)
            ->where('innovation_id', '=', $id)
            ->exists()) {

            return true;
        }
        else
        {
            return false;
        }
    }
} 