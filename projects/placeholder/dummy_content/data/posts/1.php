<?php

use App\Cms\Page;


$post = new Page();

$post->title = "The Love of Money";
$post->subtitle = 'Worship Lesson Sunday 30-01-2022';
$post->slug = '1';
$post->intro = 'Worship Lesson "The Love of Money" presenter Jibao Mansaray Lesson from Sunday 30-01-2022';
$post->poster = '/assets/paper_theme_v2/img/post/Post1.jpg';

// content
$post->content = '
<h2>The Love of Money</h2>
<p>Worship Lesson "The Love of Money" presenter Jibao Mansaray Lesson from Sunday 30-01-2022</p>


<iframe src="https://www.facebook.com/plugins/video.php?height=314&href=https%3A%2F%2Fwww.facebook.com%2Fwyreemadcoc%2Fvideos%2F1299511560549745%2F&show_text=false&width=560&t=0" width="560" height="314" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
    ';

// display settings
// @todo not sure about this format yet
$post->settings = [
    // 'template' => 'one_column' // template to use
];


return $post;
