<?php

namespace Modules\CongregateUi\Events;

use Illuminate\Queue\SerializesModels;

class MenuLevelTransition
{
    private $handled = false;
    private $builtHtml = "";

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(private array $entries, private int $level = 0)
    {
    }

    public function getEntries(): array
    {
        return $this->entries;
    }

    public function getLevel(): int
    {
        return $this->level;
    }

    public function setHtml(string $html)
    {
        $this->builtHtml = $html;
    }

    public function getHtml(): string
    {
        return $this->builtHtml;
    }

    public function setHandled($handled)
    {
        $this->handled = $handled;
    }

    public function wasHandled()
    {
        return $this->handled;
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
