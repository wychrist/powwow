<?php

namespace Modules\CongregateCms\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class PageController extends Controller
{
    public function indexAction(string|int $id)
    {
        // @todo We need to implement this asap!!!
        if ($id == '5' || $id == 'about-us') {
            return  $this->getAboutusPage();
        } else {
            $path = content_dir("data/pages/{$id}.php");
            if (file_exists($path)) {
                $page = include $path;
            }
        }

        if($page) {
            $template = config()->get('congregatecms.page_default_template', 'one_column');
            $template = $page->template ? $page->template : $template; // @todo refactor this code. we need a post setting !?!?!
            return custom_template($template, ['page' => $page]);
        } else {
            abort(404);
        }

    }


    private function getAboutusPage(): string
    {

        $data = include_once content_dir('data/paper_2/about_us_template.php');

        //$data['page']->title = 'This is a new title'; // we are overriding the title for the page

        //$whoWeAreChildren = $data['whoWeAre']->children;

        // we are overriding the content for the first page in section 1
        // $whoWeAreChildren[0]->content = 'We are working hard in wyreema and we are loving it';

        //$data['whoWeAre']->children = $whoWeAreChildren;

        return render_template('about_us', $data);
    }
}
