<?php

use App\Entity\MenuItem;

$homeMenu = new MenuItem();

// home
$homeMenu->addChild(new MenuItem(['title' => 'Home', 'url' => url('index')]));

// about us
$homeMenu->addChild(new MenuItem(['title' => 'About us', 'url' => url('pages', ['id' => 'about-us'])]));

// spiritual
$homeMenu->addChild(new MenuItem(['title' => 'About us', 'url' => url('pages', ['id' => 'spiritual'])]));


return $homeMenu;
