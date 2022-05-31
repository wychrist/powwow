<?php

use App\Cms\Page;

$content = [
    'title' => 'Wyreema Christians Inc.',
    'subtitle' => 'Simply Christians meeting and worshipping in Wyreema',
    'intro' => 'intro string',
    'content' => '',
    'image' => '/assets/paper_theme_v2/img/hall_new_angle.JPG',
    'images' => [
        'first' => '',
        'second' => ''
    ],
];
return new Page($content);
