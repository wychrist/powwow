<?php
if(!defined('WYCHRIST_INIT')){
  exit;
}

return [
  'theme' => env('DEFAULT_THEME', 'base'),
  'menu' => 'menus.php',
  'routes' => 'routes.php',
  'socials' => [
    'facebook' => 'https://www.facebook.com/wyreemadcoc'
  ]
];