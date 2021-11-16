<?php
define('WYCHRIST_INIT', true);

require_once '../vendor/autoload.php';
require_once '../app/bootstrap.php';


handle_route($_SERVER['REQUEST_URI']); 