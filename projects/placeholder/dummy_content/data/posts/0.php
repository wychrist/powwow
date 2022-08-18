<?php

use App\Cms\Page;


$post = new Page();

$post->title = "Counter Culture";
$post->subtitle = 'Worship Lesson Sunday 06-02-2022';
$post->slug = '0';
$post->intro = 'Worship Lesson "Counter Culture" presenter Bill Dusza Lesson from Sunday 06-02-2022';
$post->image = '/assets/paper_theme_v2/img/post/Post0.jpg';
$post->images = [
    '/assets/paper_theme_v2/img/post/Post0_1.jpg',
    '/assets/paper_theme_v2/img/post/Post0_2.jpg',
    '/assets/paper_theme_v2/img/post/Post0_3.jpg',
    '/assets/paper_theme_v2/img/post/Post0_4.jpg',
    '/assets/paper_theme_v2/img/post/Post0_5.jpg',
];
$post->video = 'ZK0GQ9VXCbI';

// content
$post->content = '
<h2>Counter Culture</h2>
<p>Worship Lesson "Counter Culture" presenter Bill Dusza Lesson from Sunday 06-02-2022</p>
    ';

// display settings
// @todo not sure about this format yet
$post->settings = [
    // 'template' => 'one_column' // template to use
];


return $post;
