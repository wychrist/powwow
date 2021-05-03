<?php

namespace App\Events\Api\User;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Created
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private User $user;

    private array $payload;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, array $payload = [])
    {
        $this->user = $user;
        $this->payload = $payload;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getPayload(): array
    {
        return $this->payload;
    }

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
