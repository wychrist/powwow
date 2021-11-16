<?php
if(!defined('WYCHRIST_INIT')){
  exit;
}


$content = [
  'title' => 'About us'
];
serve_template('templates/about_us_template', $content);