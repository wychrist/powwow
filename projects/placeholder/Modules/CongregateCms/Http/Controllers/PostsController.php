<?php

namespace Modules\CongregateCms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CongregateCms\Repositories\ContentRepository;

class PostsController extends Controller
{

    public function indexAction(ContentRepository $repo)
    {
        $post = $repo->getLatestPost();
        $template = config()->get('congregatecms.post_default_template', 'one_column');

        $template = $post->template ? $post->template : $template; // @todo refactor this code. we need a post setting !?!?!

        $next = $repo->getNextPost($post->slug);
        $previous = $repo->getPreviousPost($post->slug);

        return custom_template($template, ['post' => $post, 'nextPost' => $next, 'previousPost' => $previous]);
    }

    public function listAction(ContentRepository $repo)
    {
        $list = $repo->getListOfPosts();

        return custom_template('congregatecms::templates/posts_list', compact('list'));
    }

    public function serveAction(string | int $id, ContentRepository $repo)
    {
        $template = config()->get('congregatecms.post_default_template', 'one_column');
        $post = $repo->findAPost($id);

        if (!$post) {
            return custom_template('congregatecms::templates/post_not_found', [
                'list' => $repo->getListOfPosts(5)
            ]);
        }

        $template = $post->template ? $post->template : $template; // @todo refactor this code. we need a post setting !?!?!

        $next = $repo->getNextPost($post->slug);
        $previous = $repo->getPreviousPost($post->slug);

        return custom_template($template, ['post' => $post, 'nextPost' => $next, 'previousPost' => $previous]);
    }
}
