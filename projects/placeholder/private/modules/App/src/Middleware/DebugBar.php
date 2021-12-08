<?php

namespace App\Middleware;

use Closure;
use DebugBar\StandardDebugBar;
use Fluid\Base\Request;
use Fluid\Http\Middleware;

class DebugBar extends Middleware
{

    /**
     * @var StandardDebugBar
     */
    private $debugbar;

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($request->isXmlHttpRequest() || !config()->get('dev.in_dev_mode')) {
            return $response;
        }

        if ($response->headers->get('content-type') != null && $response->headers->get('content-type') != 'text/html') {
            return $response;
        }

        $config = make('Fluid\Base\Config');


        $allowedClients = $config->get('dev.allow_debugbar_for_client');
        $showBar = $config->get('dev.show_debugbar');

        if ($showBar && php_sapi_name() != 'cli' && (in_array('*', $allowedClients) || !empty(array_intersect($allowedClients, $request->getClientIps())))) {
            $this->debugbar = new \DebugBar\StandardDebugBar();

            $request->attributes->set('debugbar', $this->debugbar);

            $event = new \Fluid\Events\Debugbar($this->debugbar);
            dispatch($event);
        }


        return $response;
    }


    public function after(Request $request, Closure $next, $response)
    {
        $response =  $next($request, $response);

        if ($this->debugbar) {

            $render = $this->debugbar->getJavascriptRenderer();
            $render->setOptions(['base_url' => $request->attributes->get('_public_url') . trim($render->getBaseUrl(), '/')]);

            $content = $response->getContent();
            $content .= "<html><head>{$render->renderHead()}</head><body>{$render->render()}</body>";
            $response->setContent($content);
        }

        return $response;
    }
}
