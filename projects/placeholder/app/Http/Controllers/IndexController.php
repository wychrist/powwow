<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cms\Page;

class IndexController extends Controller
{

    public function indexAction()
    {

        $page = require_once(content_dir("data/paper_2/index_page_hero_section.php"));
        $data = [
            'page' => $page,
            'content' => $page
        ];

        return render_template('home', $data);
    }
}
