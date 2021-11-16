<?php
if(!defined('WYCHRIST_INIT')){
  exit;
}

$content = [
    'title' => 'Wychrist',
    'homepage_title' => 'Who we are?',
    'our_description' => 'Wyreema Christian description here',
    'images' => [
      'first' => '',
      'second' => ''
    ]
];

serve_template('base/templates/home_template', $content);
