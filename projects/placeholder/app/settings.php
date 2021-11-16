<?php
if(!defined('WYCHRIST_INIT')){
  exit;
}

return [
  'theme' => env('DEFAULT_THEME', 'base'),
  'menu' => 'menus.php',
  'routes' => 'routes.php',
  'socials' => [
    'facebook' => env('FACEBOOK_LINK'),
     'youtube' => env('YOUTUBE_LINK'),
     'twitter' => env('TWITTER_LINK'),
  ]
];