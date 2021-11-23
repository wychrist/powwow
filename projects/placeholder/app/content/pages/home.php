<?php

use App\Cms\Page;

if(!defined('WYCHRIST_INIT')){
  exit;
}

$content = [
    'title' => 'Wyreema Christians',
    'subtitle' => 'Simply Christians',
    'intro' => 'intro string',
    'content' => 'content for body of page',
    'image' => './assets/paper_theme_v2/img/header-samuel-mcgarrigle-GVRRtaLj3LU-unsplash.jpg',
    'images' => [
      'first' => '',
      'second' => ''
    ],
];



$page =  new Page($content);

$data = [
   'page' => $page
];

serve_template('templates/home_template', $data);
