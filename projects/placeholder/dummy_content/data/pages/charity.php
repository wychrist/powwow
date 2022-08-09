<?php

use App\Cms\Page;

$page = new Page();

$page->title = "Charity Details";
$page->slug  = "charity";
$page->content = "Our Mission";



return $page;
