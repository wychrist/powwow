<?php

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

$page = new Page($content);

$section1 = new Page(['title' => 'Who we are']);
$section1Page1Content = ['content' => 'Who we are section, page 1', 'image' => './assets/img/worship_hall_1.webp'];
$section1Page2Content = ['content' => 'Who we are section, page 2', 'image' => '/assets/img/worship_hall_2.webp'];

$section1->children = [
  new Page($section1Page1Content),
  new Page($section1Page2Content),
];


return [
  'page' => $page,
  'section1' => $section1
];