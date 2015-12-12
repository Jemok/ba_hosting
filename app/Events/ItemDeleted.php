<?php

namespace Md\Events;

use Md\Chat;
use Md\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ItemDeleted extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $id;

    /**
     * @param Item $item
     */
    public function __construct(Chat $item)
    {
        $this->id = $item->id;
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