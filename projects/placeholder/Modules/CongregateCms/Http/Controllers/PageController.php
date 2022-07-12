<?php

namespace Modules\CongregateCms\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CongregateCms\Repositories\ContentRepository;

class PageController extends Controller
{
    public function indexAction(string|int $id, ContentRepository $repo)
    {
        // @todo We need to implement this asap!!!
        if ($id == '5' || $id == 'about-us') {
            return  $this->getAboutusPage();
        } else {
            $page = $repo->findAPage($id);
            if ($page) {
                $template = config()->get('congregatecms.page_default_template', 'one_column');
                $template = $page->template ? $page->template : $template; // @todo refactor this code. we need a post setting !?!?!
                return custom_template($template, ['page' => $page]);
            } else {
                abort(404);
            }
        }
    }


    private function getAboutusPage(): string
    {

        $data = include_once content_dir('data/paper_2/about_us_template.php');

        return render_template('about_us', $data);
    }
}
