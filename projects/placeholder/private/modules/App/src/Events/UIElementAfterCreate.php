<?php

namespace App\Events;

use Fluid\EventDispatcher\Event;

class UIElementAfterCreate extends Event
{
    private $node;
    private $id;

    public function __construct(\App\Lib\Ui\Html $node, $id)
    {
        $this->node = $node;
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNode()
    {
        return $this->node;
    }

    public function getObj()
    {
        return $this->node;
    }

}
