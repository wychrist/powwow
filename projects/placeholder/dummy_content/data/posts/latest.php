<?php

use App\Cms\Page;


$post = new Page();

$post->title = "Latest Post";
$post->intro = "Porttitor Felis Nulla Neque Senectus Nunc";
$post->poster = '/assets/img/latest_post.jpg';

// content
$post->content ="
<h2>Aliquam Morbi Nostra Amet A</h2>
<p>Nullam leo Lectus interdum justo consequat. Pretium tortor risus commodo tincidunt <strong>imperdiet</strong> nisl ad suspendisse faucibus Metus egestas orci magnis dolor neque pharetra accumsan. Litora risus, sodales. Varius augue vivamus fames ut orci mollis volutpat.</p>

<p><strong>Molestie</strong> condimentum. <em>Arcu</em> montes <em>luctus</em> mi nibh commodo ridiculus, arcu sem <em>scelerisque</em> habitasse parturient praesent conubia et sed pulvinar arcu vitae dis sagittis. Cras ad malesuada fermentum.</p>

<p>Auctor ut facilisis sapien magna scelerisque. Cursus fames fames. Netus Placerat accumsan aptent nonummy dignissim amet Pharetra felis.</p>

<p>Sit egestas maecenas turpis dignissim mollis amet sociosqu etiam dictumst pede rutrum dictumst. Interdum diam nisl dignissim phasellus justo iaculis.</p>";


// display settings
// @todo not sure about this format yet
$post->settings = [
    // 'template' => 'one_column' // template to use
];


return $post;
