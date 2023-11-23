<?php

use App\Entity\MenuItem;
use Modules\CongregateCms\Services\Url;

$menuItemsData = [  // the order of this array is important
    'home' => [
        'label' => 'Home',
        'link' => '/',
        'children' => []
    ],
    'garden' => [
        'label' => 'Community Garden',
        'link' => Url::page('garden'),
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

$menus = []; // array of menu instances initiated
$disable = ['about-us']; // keys in here will be remove from the menu list

foreach ($menuItemsData as $key => $data) {
    if (in_array($key, $disable)) {
        continue;
    }
    $menus[$key] = new MenuItem($data);
}

return $menus;
