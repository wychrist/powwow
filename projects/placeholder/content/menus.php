<?php

use App\Entity\MenuItem;
use Modules\CongregateCms\Services\Url;

$menuItemsData = [
  'home' => [
    'label' => 'Home',
    'link' => '/',
    'children' => []
  ],
  'about-us' => [
    'label' => 'About Us',
    'link' => Url::page('about-us'),
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
