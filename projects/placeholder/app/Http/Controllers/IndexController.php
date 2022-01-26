<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cms\Page;

class IndexController extends Controller
{

    public function indexAction()
    {
        $content = [
            'title' => 'Wyreema Christians',
            'subtitle' => 'Simply Christians - with a very long subtitle, does it look silly',
            'intro' => 'intro string',
            'content' => 'content for body of page',
            'image' => '/assets/img/church.jpg',
            'images' => [
                'first' => '',
                'second' => ''
            ],
        ];
        $page =  new Page($content);

        $page->facebook = settings('app.socials.facebook');
        $page->google = settings('app.socials.google');
        $page->twitter = settings('app.socials.twitter');
        $page->github = settings('app.socials.github');
        $page->email = settings('app.socials.email');

        $data = [
            'page' => $page,
            'content' => $page
        ];

        return render_template('home', $data);
    }
}
