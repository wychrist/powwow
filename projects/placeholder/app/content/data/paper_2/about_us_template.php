<?php

use App\Cms\Page;

$content = [
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

$page = new Page($content);

$whoWeAre = new Page(['title' => 'Who we are']);
$whoWeArePage1Content = ['content' => 'Who we are section, page 1', 'image' => './assets/img/worship_hall_1.webp'];
$whoWeArePage2Content = ['content' => 'Who we are section, page 2', 'image' => './assets/img/worship_hall_2.webp'];

$whoWeAre->children = [
  new Page($whoWeArePage1Content),
  new Page($whoWeArePage2Content),
];

$communityInvolvement = new Page(['title' => 'Community Involvement']);
$communityInvolvementPage1Content = ['title' => 'Tony\'s Kitchen', 'content' => 'Blankets and jumpers for the homeless', 'image' => './assets/img/placeholder.jpg'];
$communityInvolvementPage2Content = ['title' => 'Operation Christmas Child', 'content' => 'Shoe boxes for impoverished children full of essential items and items to love. Packed and ready to ship for Christmas.', 'image' => './assets/img/Operation_chrismas_Child.jpg'];

$communityInvolvement->children = [
  new Page($communityInvolvementPage1Content),
  new Page($communityInvolvementPage2Content),
];

$history = new Page(['title' => 'History']);
$historyPage1Content = ['title' => 'Worshiping in the Homes', 'content' => 'Worshiping in homes.', 'image' => './assets/img/worship_home_1.jpg'];
$historyPage2Content = ['title' => 'Worshiping in the Hall', 'content' => 'Worshiping in the Wyreema Community Hall.', 'image' => './assets/img/worship_hall_3.jpg'];

$history->children = [
  new Page($historyPage1Content),
  new Page($historyPage2Content),
];


return [
  'page' => $page,
  'whoWeAre' => $whoWeAre,
  'communityInvolvement' => $communityInvolvement,
  'history' => $history,
];
