<?php

namespace App\Controller;

use App\Cms\Page;
use Fluid\Theme\Contracts\ThemeInterface;
use Fluid\Base\Response;
use Fluid\Http\Controller;

/**
 * Description of Index
 *
 * @author unleash
 */
class IndexController extends Controller
{

    /**
     * @var ThemeInterface
     */
    private $theme;

    public function __construct(ThemeInterface $theme)
    {
        $this->theme = $theme;
    }


    public function indexAction(Response $response): Response
    {

        $content = [
            'title' => 'Wyreema Christians',
            'subtitle' => 'Simply Christians - with a very long subtitle, does it look silly',
            'intro' => 'intro string',
            'content' => 'content for body of page',
            'image' => './assets/img/church.jpg',
            'images' => [
                'first' => '',
                'second' => ''
            ],
        ];

        $page = new Page($content);
        $data = [
            'page' => $page
        ];

        return $response->setContent(render_template('templates/home_template', $data));
    }

    public function getDefaultContent(): string
    {
        return $this->theme->getTwig()->render('@app/index_view.html.twig');
    }
}
