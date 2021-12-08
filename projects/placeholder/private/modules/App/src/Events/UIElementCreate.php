<?php

namespace App\Events;

use Fluid\EventDispatcher\Event;

class UIElementCreate extends Event
{

    private $name;
    private $obj;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setObj(\App\Lib\Ui\Html $obj)
    {
        $this->obj = $obj;
    }

    public function getObj()
    {
        return $this->obj;
    }

}
