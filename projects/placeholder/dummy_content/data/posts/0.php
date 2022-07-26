<?php

use App\Cms\Page;


$post = new Page();

$post->title = "Counter Culture";
$post->subtitle = 'Worship Lesson Sunday 06-02-2022';
$post->slug = '0';
$post->intro = 'Worship Lesson "Counter Culture" presenter Bill Dusza Lesson from Sunday 06-02-2022';
$post->poster = '/assets/paper_theme_v2/img/post/Post0.jpg';

// content
$post->content = '
<h2>Counter Culture</h2>
<p>Worship Lesson "Counter Culture" presenter Bill Dusza Lesson from Sunday 06-02-2022</p>


<iframe src="https://www.facebook.com/plugins/video.php?href=https%3A%2F%2Fwww.facebook.com%2Fwyreemadcoc%2Fvideos%2F5012606668761855%2F&width=500&show_text=false&height=282&appId" width="500" height="282" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" allowFullScreen="true"></iframe>
    ';

// display settings
// @todo not sure about this format yet
$post->settings = [
    // 'template' => 'one_column' // template to use
];


return $post;
