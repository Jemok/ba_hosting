<?php

namespace Md\Events;

use Md\Events\Event;
use Md\Chat;
use Md\Message;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ItemCreated extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $id;

    /**
     * @param Message $message
     */
    public function __construct(Message $message)
    {
        $this->id = $message->id;

    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['itemAction'];
    }

}
