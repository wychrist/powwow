<?php

use App\Entity\MenuItem;

$menuItemsData = [
  'home' => [
    'label' => 'Home',
    'link' => '/',
    'children' => []
  ],
  'about-us' => [
    'label' => 'About Us',
    'link' => '/pages/about-us',
    'children' => []
  ],
  'spiritual' => [
    'label' => 'Spiritual',
    'link' => '/spiritual',
    'children' => []
  ],
  'contact-us' => [
    'label' => 'Contact Us',
    'link' => '/contact-us',
    'children' => []
  ],
];

foreach ($menuItemsData as $key => $data) {
  $menuItemsData[$key] = new MenuItem($data);
}

return $menuItemsData;
