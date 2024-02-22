<?php

use App\Cms\Page;


$post = new Page();

$post->title = "Bread of Life";
$post->subtitle = 'Still Hungry?';
$post->slug = 'bread';
$post->id = 4;
$post->intro = 'Bread of LIFE';
$post->image = '/assets/paper_theme_v2/img/post/bread_0.jpg';
$post->images = [
    '/assets/paper_theme_v2/img/post/bread_0.jpg',
    '/assets/paper_theme_v2/img/post/bread_1.jpg',
    '/assets/paper_theme_v2/img/post/bread_2.jpg',
    '/assets/paper_theme_v2/img/post/bread_3.jpg',
];
$post->video = 'ZK0GQ9VXCbI';

// content
$post->content = '
<h2>Eternal Life</h2>
<p>I am the bread of life. Whoever comes to me will never go
hungry, and whoever believes in me will never be thirsty.</p>
<p class="spiritual-quote">JOHN 6:35 NIV</p>
<p></p>
<p>...... Is not life more than food and the body more than
clothes?<p>
<p class="spiritual-quote">MAT 6:25 NIV</p>
<p></p>
<p>Blessed are those who hunger and thirst for
 righteousness, for they will be filled.</p>
<p class="spiritual-quote">MAT 5:6 NIV</p>
';

// display settings
// @todo not sure about this format yet
$post->settings = [
    // 'template' => 'one_column' // template to use
];


return $post;
