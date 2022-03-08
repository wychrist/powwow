<!-- Navbar -->
<?php
$setting = app('Modules\CongregateContract\Setting\SettingInterface');
?>
<nav class="navbar navbar-expand-lg fixed-top navbar-transparent bg-dark" color-on-scroll="120">
  <div class="navbar-translate">
    <a class="navbar-brand" href="/" rel="tooltip" title="{{ $setting->get('app.name') }}" data-placement="bottom">
      {{ $setting->get('app.name') }}
    </a>
    <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-bar bar1"></span>
      <span class="navbar-toggler-bar bar2"></span>
      <span class="navbar-toggler-bar bar3"></span>
    </button>
  </div>
  <div class="collapse navbar-collapse justify-content-end" id="navigation">
    <ul class="navbar-nav">
      <?php
      $menus = include content_dir('menus.php');
      ?>
      <?php foreach ($menus as $aMenu) : ?>
        <li class="nav-item">
          <a href="<?= $aMenu->link ?>" class="nav-link" rel="tooltip" title="<?= $aMenu->label ?>" data-placement="bottom">
            <p><?= $aMenu->label ?></p>
          </a>
        <?php endforeach; ?>
        </li>
        <?php if ($setting->get('app.socials.facebook')) : ?>
          <li class="nav-item">
            <a href="<?= $setting->get('app.socials.facebook') ?>" class="btn btn-facebook btn-round" rel="tooltip" title="Like us on Facebook!">
              <i class="fa fa-facebook-square"></i>
            </a>
          </li>
        <?php endif; ?>
        <?php if ($setting->get('app.socials.youtube')) : ?>
          <li class="nav-item">
            <a href="<?= $setting->get('app.socials.youtube') ?>" class="btn btn-youtube btn-round" rel="tooltip" title="Youtube">
              <i class="fa fa-youtube"></i>
            </a>
          </li>
        <?php endif; ?>
        <?php if ($setting->get('app.socials.twitter')) : ?>
          <li class="nav-item">
            <a href="<?= $setting->get('app.socials.twitter') ?>" class="btn btn-twitter btn-round" rel="tooltip" title="Tweet!">
              <i class="fa fa-twitter"></i>
            </a>
          </li>
        <?php endif; ?>
        <?php if ($setting->get('app.socials.instagram')) : ?>
          <li class="nav-item">
            <a href="<?= $setting->get('app.socials.instagram') ?>" class="btn btn-instagram btn-round" rel="tooltip" title="Instagram">
              <i class="fa fa-instagram"></i>
            </a>
          </li>
        <?php endif; ?>
        <li class="nav-item">
          <p class="navbar-buffer-item"></p>
        </li>
    </ul>
  </div>
</nav>
<!-- End Navbar -->
<div class=" page-header section-dark" style="background-image: url(<?= $page->image ?>)">
  <div class="filter"></div>
  <div class="content-center">
    <div class="container">
      <div class="title-brand">
        <h1 class="presentation-title">{{ $page->title }}</h1>
      </div>
      <h2 class="presentation-subtitle text-center">{{ $page->subtitle }}</h2>
    </div>
  </div>
</div>