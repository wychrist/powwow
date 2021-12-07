<?php
if (!defined('WYCHRIST_INIT')) {
  exit;
}

use App\Cms\Page;
use App\Repository\PageRepository;

$data = include_once content_dir('data/paper_2/about_us_template.php');

/* $content = [
  'title' => 'About US',
  'subtitle' => 'Who we are, What we do',
  'intro' => 'intro string',
  'content' => 'content for body of page',
  'image' => './assets/img/emily-morter-8xAA0f9yQnE-unsplash-cropped.webp',
  'images' => [
    'first' => '',
    'second' => ''
  ],
];


$section1 = PageRepository::findPageByName('WhoWeAreSection');

// $page->content = $content;


$page =  new Page($content);


$data = [
  'page' => $page,
  'whoWeAre' => $section1
]; */

$data['page']->title = 'This is a new title'; // we are overriding the title for the page

$whoWeAreChildren = $data['whoWeAre']->children;

// we are overriding the content for the first page in section 1
$whoWeAreChildren[0]->content = 'We are working hard in wyreema and we are loving it';

$data['whoWeAre']->children = $whoWeAreChildren;


serve_template('templates/about_us_template', $data);
