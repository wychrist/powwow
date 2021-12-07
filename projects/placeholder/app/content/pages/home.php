<?php

use App\Cms\Page;

if (!defined('WYCHRIST_INIT')) {
  exit;
}

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

serve_template('templates/home_template', $data);
