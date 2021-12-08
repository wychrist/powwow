<?php

namespace App;

use Fluid\Module\Module as Base;
use App\Listener\Subscriber;

if (!defined('FLUID_PRIVATE_DIR')) {
    define('FLUID_PRIVATE_DIR', dirname(__DIR__));
}

require_once 'functions.php';

class App extends Base
{
    public function deployAssets($force = false): self
    {
        $result = parent::deployAssets($force);
        $path = FLUID_VENDOR_DIR . '/maximebf/debugbar/src/DebugBar/Resources';
        if (file_exists($path)) {
            $this->getFilesystem()->mirror($path, $this->getPublicDir() . '/vendor/maximebf/debugbar/src/DebugBar/Resources');
        }

        return $result;
    }

    public function undeployAssets(): self
    {
        $path = $this->getPublicDir() . '/vendor/maximebf/debugbar/src/DebugBar/Resources';

        if (file_exists($path)) {
            $this->getFilesystem()->remove($this->getPublicDir() . '/vendor/maximebf/debugbar/src/DebugBar/Resources');
        }

        return parent::unDeployAssets();
    }

    protected function injectSubscriberClass()
    {
        injector()->share(Subscriber::class);

        $this->getEventDispatcher()->addSubscriber(make(Subscriber::class, [$this]));
    }
}
