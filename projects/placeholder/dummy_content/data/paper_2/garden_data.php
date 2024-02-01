<?php

use App\Cms\Page;

$content = [
    'title' => 'Community Garden',
    'subtitle' => 'Australia Day Awards',
    'intro' => 'intro string',
    'content' => 'content for body of page',
    'image' => '/assets/paper_theme_v2/img/aus_day_presentation.jpg',
    'images' => [
        'first' => '',
        'second' => ''
    ],
];

$page = new Page($content);

$what = new Page(['title' => 'Garden']);
$whatPage1Content = ['content' => 'The Wyreema Community Garden was founded by Wyreema Christians with a vision to transform a vacant piece of land into a vibrant, green sanctuary. Our garden has since blossomed into a tapestry of colours and flavours, drawing together people from all walks of life who share a passion for gardening, sustainability, and community.', 'image' => '/assets/paper_theme_v2/img/Garden_Close.jpg'];
$whatPage2Content = ['content' => 'Wyreema Community Garden thrives because of our dedicated members. Meeting every 1st and 3rd Tuesdays 9:30 am at the Wyreema Community Hall. We invite you to join us, roll up your sleeves, and be part of this green revolution. Together, we\'ll sow the seeds of positive change, one garden bed at a time. </br> </br> <a href="https://www.facebook.com/profile.php?id=61550695902390" class="btn btn-facebook btn-block" rel=" tooltip" title="Wyreema Community Garden\'s Facebook"><i class="fa fa-facebook"></i>Wyreema Community Garden Facebook Page<i class="fa fa-facebook"></i></a>', 'image' => '/assets/paper_theme_v2/img/Gardening.jpg'];

$what->children = [
    new Page($whatPage1Content),
    new Page($whatPage2Content),
];

$where = new Page(['title' => '2023 Toowoomba Carnival of Flowers']);
$wherePage1Content = ['title' => '1st Prize', 'content' => 'The Chronicle Garden Competition Not For Profit Category Winners for 2023', 'image' => '/assets/paper_theme_v2/img/Prize.jpg'];
$wherePage2Content = ['title' => 'Sidewalk Art', 'content' => 'The community garden all decorated and in bloom ready for judging.', 'image' => '/assets/paper_theme_v2/img/Sidewalk.webp'];

$where->children = [
    new Page($wherePage1Content),
    new Page($wherePage2Content),
];

$aus = new Page(['title' => 'Australia Day Awards']);
$ausPage1Content = ['title' => 'Presentation', 'content' => 'We were surprised to receive a letter informing us that we were nominated for an Australia Day Award. We were even more surprised and delighted to receive the award. The community garden has had a larger impact on Wyreema then we even realised.', 'image' => '/assets/paper_theme_v2/img/aus_day_group.jpg'];
$ausPage2Content = ['title' => 'Award', 'content' => 'Wyreema Community Gardens Cambooya, Community Group Award, Australia Day Awards 2024', 'image' => '/assets/paper_theme_v2/img/aus_day_award.jpg'];

$aus->children = [
    new Page($ausPage1Content),
    new Page($ausPage2Content),
];

$why = new Page(['title' => 'Produce Stall']);
$whyPage1Content = ['title' => 'Under Construction', 'content' => 'Getting ready for the Carnival of Flowers the community garden and Wyreema Christians volunteers building the produce cart.', 'image' => '/assets/paper_theme_v2/img/Stall In progress.webp'];
$whyPage2Content = ['title' => 'Fully Loaded', 'content' => 'The produce stall, fully loaded and ready to share with the Wyreema Community.', 'image' => '/assets/paper_theme_v2/img/Stall.jpg'];

$why->children = [
    new Page($whyPage1Content),
    new Page($whyPage2Content),
];


return [
    'page' => $page,
    'what' => $what,
    'where' => $where,
    'why' => $why,
    'aus_day' => $aus,
];
