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
            'image' => './assets/img/church.jpg',
            'images' => [
                'first' => '',
                'second' => ''
            ],
        ];
        $page =  new Page($content);

        $data = [
            'page' => $page
        ];
        return render_template('templates/home_template', $data);
    }
}
