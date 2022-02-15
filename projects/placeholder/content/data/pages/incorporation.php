<?php

use App\Cms\Page;

$page = new Page();

$page->title = "Incorporation Details";
$page->content = "Certificate of Incorporation, Office Bearers, Constitution, Contact Details";



return $page->content;
