<?php $this->layout('layouts/main') ?>

<?php
  $facebook = $this->settings('socials.facebook');
  $google = $this->settings('socials.google');
  $twitter= $this->settings('socials.twitter');
?>

    <div class="page-header page-header-small">
      <div class="page-header-image" data-parallax="true" style="background-image: url(<?=(isset($bg_image))? $bg_image:'/assets/base_theme/img/bg6.jpg' ?>);">
      </div>
      <div class="content-center">
        <div class="container">
          <h1 class="title"><?=$title ?></h1>
          <div class="text-center">
            <?php if($facebook): ?>
            <a href="<?=$facebook ?>" class="btn btn-primary btn-icon btn-round">
              <i class="fab fa-facebook-square"></i>
            </a>
            <?php endif; ?>
            <?php if($twitter): ?>
            <a href="<?=$twitter ?>" class="btn btn-primary btn-icon btn-round">
              <i class="fab fa-twitter"></i>
            </a>
            <?php endif; ?>
            <?php if($google): ?>
            <a href="<?=$google ?>" class="btn btn-primary btn-icon btn-round">
              <i class="fab fa-google-plus"></i>
            </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

      <div class="content-center">
        <div class="container">
          <h1 class="title"><?=$aboutpage_title ?></h1>
        </div>
      </div>