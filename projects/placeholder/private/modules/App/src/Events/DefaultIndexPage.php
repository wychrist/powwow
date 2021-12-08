<?php

namespace App\Events;

use Fluid\EventDispatcher\Event;

class DefaultIndexPage extends Event
{

    private $response = false;
    private $controller;

    public function __construct(\App\Controller\IndexController $controller)
    {
        $this->controller = $controller;
    }

    /**
     *
     * @return \App\Controller\IndexController
     */
    public function getController()
    {
        return $this->controller;
    }

    public function setResponse(\Fluid\Base\Response $res)
    {
        $this->response = $res;
    }

    public function getResponse()
    {
        return $this->response;
    }

}
