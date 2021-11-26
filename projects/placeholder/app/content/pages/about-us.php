<?php
if (!defined('WYCHRIST_INIT')) {
  exit;
}

use App\Cms\Page;

$content = [
  'title' => 'About US',
  'subtitle' => 'Who we are, What we do',
  'intro' => 'intro string',
  'content' => 'content for body of page',
  'image' => './assets/paper_theme_v2/img/emily-morter-8xAA0f9yQnE-unsplash.jpg',
  'images' => [
    'first' => '',
    'second' => ''
  ],
];


$page =  new Page($content);

$data = [
  'page' => $page
];

serve_template('templates/about_us_template', $data);
