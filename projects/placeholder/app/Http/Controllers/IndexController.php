<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cms\Page;

class IndexController extends Controller
{

    public function indexAction()
    {
        $content = [
            'title' => 'Wyreema Christians Inc.',
            'subtitle' => 'Simply Christians meeting and worshipping in Wyreema',
            'intro' => 'intro string',
            'content' => '',
            'image' => '/assets/img/church.jpg',
            'images' => [
                'first' => '',
                'second' => ''
            ],
        ];
        $page =  new Page($content);

        $data = [
            'page' => $page,
            'content' => $page
        ];

        return render_template('home', $data);
    }
}
