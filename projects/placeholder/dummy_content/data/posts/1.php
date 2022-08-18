<?php

use App\Cms\Page;


$post = new Page();

$post->title = "The Love of Money";
$post->subtitle = 'Worship Lesson Sunday 30-01-2022';
$post->slug = '1';
$post->intro = 'Worship Lesson "The Love of Money" presenter Jibao Mansaray Lesson from Sunday 30-01-2022';
$post->image = '/assets/paper_theme_v2/img/post/Post1.jpg';
$post->video = 'gYAWId66KYc';
// content
$post->content = '
<h2>The Love of Money</h2>
<p>Worship Lesson "The Love of Money" presenter Jibao Mansaray Lesson from Sunday 30-01-2022</p>';

// display settings
// @todo not sure about this format yet
$post->settings = [
    // 'template' => 'one_column' // template to use
];


return $post;
