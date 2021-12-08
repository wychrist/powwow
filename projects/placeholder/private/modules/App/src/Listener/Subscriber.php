<?php

namespace App\Listener;

use App\App;
use Fluid\Contracts\EventDispatcher\SubscriberInterface;
use Fluid\Database\Events\OrmEntityManagerConfig;

class Subscriber implements SubscriberInterface
{

    /**
     * @var App
     */
    private $module;

    public function __construct(App $app)
    {
        $this->module = $app;
    }

    public function getModule()
    {
        return $this->module;
    }


    public function onRouteSetup($event)
    {
        include_once  $this->getModule()->getBaseDir('config/routes.php');
    }

    public function onLoadConfig($Event)
    {
        //
    }

    public function onMiddlewareSetup($event)
    {
        $event->set('core.maintenance', \App\Middleware\MaintenanceMiddleware::class);
        $event->set('debug_bar_middleware', \App\Middleware\DebugBar::class);
    }

    public function onRouteAdded($event)
    {
        $event->getRoute()->setMiddleware('core.maintenance');
        $event->getRoute()->setMiddleware('debug_bar_middleware');
    }

    public function onTwigSetup($Event)
    {
        $Event->addPath($this->getModule()->getName(), $this->getModule()->getBaseDir('/views'));
    }

    public function onDebugbar(\Fluid\Events\Debugbar $Event)
    {
    }

    public function onServiceSetup(\Fluid\Events\InjectService $Event)
    {
        (new \App\Service\ServiceSetup())->setup($Event);
    }

    public function onReady(\Fluid\Events\SystemReady $Event)
    {
    }

    public function onResponseSend(\Fluid\Events\OnResponseSend $ResponseEvent)
    {

        if (!config()->get('app.inject_javascript_and_css_in_response')) {
            return false;
        }

        $content = $ResponseEvent->getResponse()->getContent();
        $assets = include_once $this->getModule()->getBaseDir('/assets_to_autoload.php');
        $assetStr = '';
        $footerStr = '';


        $Event = make(\App\Events\AssetInject::class, [$assets]);
        app()->getEventDispatcher()->dispatch($Event, $Event::NAME);


        foreach ($Event->getHeaderJsLinks() as $id => $link) {
            $assetStr .= '<script type="text/javascript" src="' . $link . '"></script>' . "\r\n";
        }

        foreach ($Event->getHeaderCssLinks() as $id => $link) {
            $assetStr .= '<link rel="stylesheet" type="text/css" href="' . $link . '">';
        }

        if ($Event->getHeaderJsContent()) {
            $assetStr .= '<script>' . $Event->getHeaderJsContent() . '</script>';
        }

        if ($Event->getHeaderCssContent()) {
            $assetStr .= '<style>' . $Event->getHeaderCssContent() . '</style>';
        }

        foreach ($Event->getFooterJsLinks() as $id => $link) {
            $footerStr .= '<script type="text/javascript" src="' . $link . '"></script>';
        }

        if ($Event->getFooterJsContent()) {
            $footerStr .= '<script type="text/javascript">' . $Event->getFooterJsContent() . '</script>';
        }

        $ResponseEvent->getResponse()->setContent(str_replace(['</title>', '</body>'], ['</title>' . $assetStr, $footerStr . '</body>'], $content));
    }

    public function onAppOrmSetup(OrmEntityManagerConfig $Event)
    {
        if ($Event->getName() == 'app') {
            $config = config()->get('app.data.orm');
            $Event->setConfig($config);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            \Fluid\Events\SetupRoute::class => [
                'onRouteSetup'
            ],
            \Fluid\Events\SetupMiddleware::class => [
                'onMiddlewareSetup'
            ],
            \Fluid\Events\RouteAdded::class => [
                ['onRouteAdded', '-3000']
            ],

            \Fluid\Theme\Events\TwigSetup::class => 'onTwigSetup',
            \Fluid\Events\Debugbar::class => ['onDebugbar'],
            \Fluid\Events\LoadConfig::class => ['onLoadConfig'],
            \Fluid\Events\InjectService::class => 'onServiceSetup',
            \Fluid\Events\SystemReady::class => 'onReady',
            \Fluid\Events\SetupRoute::class => 'onRouteSetup',
            \Fluid\Events\OnResponseSend::class => 'onResponseSend',
            OrmEntityManagerConfig::class => 'onAppOrmSetup'
        ];
    }
}
