<?php

use App\Cms\Page;

$page = new Page();

$page->title = "Charity Details";
$page->content = "Our Mission";



return $page->content;
