<?php
if(!defined('WYCHRIST_INIT')){
  exit;
}


$content = [
  'title' => 'About us',
  'aboutpage_title' => 'This is us',
  'bg_image' => '/assets/base_theme/img/bg8.jpg'
];
serve_template('templates/about_us_template', $content);