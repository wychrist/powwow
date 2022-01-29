<?php
$page->facebook = $this->settings('app.socials.facebook');
$page->google = $this->settings('app.socials.google');
$page->twitter = $this->settings('app.socials.twitter');
$page->github = $this->settings('app.socials.github');
$page->email = $this->settings('app.socials.email');

$this->layout('layouts/landing', compact('page')) ?>


<?php $this->start('section1'); ?>
<?php if (isset($whoWeAre)) : ?>
  <?= $this->insert('sections/image_text_alternating', ['page' => $whoWeAre]); ?>
<?php endif;  ?>
<?php $this->stop(); ?>

<?php
$this->start('section2');
$this->insert('sections/elders');
$this->stop();
?>

<?php $this->start('section3'); ?>
<?php if (isset($communityInvolvement)) : ?>
  <?= $this->insert('sections/image_text_alternating', ['page' => $communityInvolvement]); ?>
<?php endif;  ?>
<?php $this->stop(); ?>

<?php $this->start('section4'); ?>
<?php if (isset($history)) : ?>
  <?= $this->insert('sections/image_text_alternating', ['page' => $history]); ?>
<?php endif;  ?>
<?php $this->stop(); ?>

<b>Body content</b>