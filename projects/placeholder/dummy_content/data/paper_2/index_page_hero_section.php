<?php

use App\Cms\Page;

$content = [
    'title' => 'Wyreema Christians Inc.',
    'subtitle' => 'Simply Christians meeting and worshipping in Wyreema',
    'intro' => 'intro string',
    'content' => '',
    'image' => '/assets/img/church.jpg',
    'images' => [
        'first' => '',
        'second' => ''
    ],
];
return new Page($content);

