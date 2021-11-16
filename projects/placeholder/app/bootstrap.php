<?php
if(!defined('WYCHRIST_INIT')){
  exit;
}

$dotenv = new Symfony\Component\Dotenv\Dotenv();

$dotEnvFile = __DIR__ .'/.env';
if(file_exists($dotEnvFile)) {
  $dotenv->load($dotEnvFile);
}

require_once  __DIR__.'/helpers.php';

