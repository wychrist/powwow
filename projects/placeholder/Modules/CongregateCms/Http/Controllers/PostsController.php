<?php

namespace Modules\CongregateCms\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PostsController extends Controller
{

    public function indexAction()
    {
        $post = include_once content_dir('data/posts/latest.php');
        $template = config()->get('congregatecms.post_default_template', 'one_column');

        $template = $post->template ? $post->template : $template; // @todo refactor this code. we need a post setting !?!?!

        return custom_template($template, ['post' => $post]);
    }

    public function serveAction(string | int $id)
    {
        $template = config()->get('congregatecms.post_default_template', 'one_column');
        $post = include_once content_dir('data/posts/latest.php');

        $template = $post->template ? $post->template : $template; // @todo refactor this code. we need a post setting !?!?!

        return custom_template($template, ['post' => $post]);
    }
}
