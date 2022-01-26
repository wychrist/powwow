<?php

use App\Cms\Page;

$page = new Page();

$page->title = "Page 1";
$page->content = "This is page one content";



return $page->content;
