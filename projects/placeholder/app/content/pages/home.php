<?php

use App\Cms\Page;

if(!defined('WYCHRIST_INIT')){
  exit;
}

$content = [
    'title' => 'Wychrist',
    'homepage_title' => 'Who we are?',
    'our_description' => 'Wyreema Christian description here',
    'images' => [
      'first' => '',
      'second' => ''
    ],
];


$data = [
   'page' => new Page($content)
];

serve_template('templates/home_template', $data);
