<?php

namespace Md\Events;

use Md\Chat;
use Md\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ItemUpdated extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $id;
    public $isCompleted;

    /**
     * @param Item $item
     */
    public function __construct(Chat $item)
    {
        $this->id = $item->id;
        $this->isCompleted = (bool) $item->isCompleted;
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
