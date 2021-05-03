<?php

namespace Modules\People\Events\Api\Person;

use Illuminate\Queue\SerializesModels;
use Modules\People\Entities\Person;

class Created
{
    use SerializesModels;

    private Person $person;
    private array $payload;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Person $person, array $payload = [])
    {
        $this->person = $person;
        $this->payload = $payload;
    }

    public function getPerson(): Person
    {
        return $this->person;
    }


    public function getPayload(): array
    {
        return $this->payload;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
