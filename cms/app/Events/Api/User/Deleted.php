<?php

namespace App\Events\Api\User;

use Illuminate\Broadcasting\PrivateChannel;

class Deleted extends Created
{

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
