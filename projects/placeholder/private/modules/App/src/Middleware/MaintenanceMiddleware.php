<?php
namespace App\Middleware;

use Closure;
use Fluid\Base\Request;
use Fluid\Base\Response;
use \App\App;
use \Fluid\Http\Middleware;

class MaintenanceMiddleware extends Middleware
{

    /**
     * @var App
     */
    private $app;

    /**
     * @var Response
     */
    private $response;

    public function __construct(App $app, Response $repsone)
    {
        $this->app = $app;
        $this->response = $repsone;
    }
    public function handle(Request $request, Closure $next)
    {
        $maintenanceFile = FLUID_PRIVATE_DIR . '/config/maintenance.flag';
        $htmlFile = $this->app->getBaseDir('views/maintenance.html');

        if (is_file($maintenanceFile)) {
            if (file_exists($htmlFile)) {
                $this->response->setContent(file_get_contents($htmlFile));
                return $this->response;
            } else {
                $this->response->setContent('<h1>We&rsquo;ll be back soon!</h1>');
            }
        }

        return $next($request);
    }

}
