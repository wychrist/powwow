<?php

use App\Cms\Page;


$post = new Page();

$post->title = "When Good is not Good Enough";
$post->subtitle = 'Worship Lesson Sunday 09-01-2022';
$post->slug = '2';
$post->id = 2;
$post->intro = 'Worship Lesson "When Good is not Good Enough" presenter Jibao Mansaray Lesson from Sunday 09-01-2022';
$post->image = '/assets/paper_theme_v2/img/post/Post2.jpg';
$post->video = 'p3CRl90-qmc';

// content
$post->content = '
<h2>When Good is not Good Enough</h2>
<p>Worship Lesson "When Good is not Good Enough" presenter Jibao Mansaray Lesson from Sunday 09-01-2022</p>';

// display settings
// @todo not sure about this format yet
$post->settings = [
    // 'template' => 'one_column' // template to use
];


return $post;
