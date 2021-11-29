<?php

use App\Entity\MenuItem;

if(!defined('WYCHRIST_INIT')){
  exit;
}

$menuItemsData = [
  'home' => [
    'label' => 'Home',
    'link' => '/',
    'children' => []
  ],
  'about-us' => [
    'label' => 'About Us',
    'link' => '/about-us.html',
    'children' => []
  ],
  'contact-us' => [
    'label' => 'Contact Us',
    'link' => '/contact-us.html',
    'children' => []
  ]
];

foreach($menuItemsData as $key => $data) {
  $menuItemsData[$key] = new MenuItem($data);
}

return $menuItemsData;