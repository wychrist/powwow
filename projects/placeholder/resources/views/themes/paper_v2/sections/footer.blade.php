<?php
$setting = app('Modules\CongregateContract\Setting\SettingInterface');
?>
<div class="container">
  <?php if ($setting->get('app.contact.email')) : ?>
    <div class="row">
      <div class="col-md-3">
        <h3 class="text-center">Contact Us</h3>
      </div>
      <div class="col-md-6">
        <h3 class="text-center">Contact Us</h3>
      </div>
      <div class="col-md-3">
        <h3 class="text-center">Legal</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 footer-black-left-col"></div>
      <div class="col-md-6">
        <a href="mailto:<?= $setting->get('app.contact.email') ?>">
          <h3 class="text-center">
            <?= $setting->get('app.contact.email') ?></h3>
        </a>
      </div>
      <div class="col-md-3 footer-black-right-col">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="/pages/charity">Charity Details</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/pages/legal">Legal Details</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/pages/incorporation">Incorporation Details</a>
          </li>
        </ul>
      </div>
    </div>
  <?php endif; ?>
  <div class="row">
    <nav class="footer-nav">
      <ul>
        <?php if ($setting->get('app.socials.facebook')) : ?>
          <li class="nav-item">
            <a href="<?= $setting->get('app.socials.facebook') ?>" class="btn btn-facebook facebook-sharrre btn-round" rel="tooltip" title="Like us on Facebook!">
              <i class="fa fa-facebook-square"></i> Facebook
            </a>
          </li>
        <?php endif; ?>
        <?php if ($setting->get('app.socials.twitter')) : ?>
          <li class="nav-item">
            <a href="<?= $setting->get('app.socials.twitter') ?>" class="btn btn-twitter twitter-sharrre btn-round" rel="tooltip" title="Tweet!">
              <i class="fa fa-twitter"></i> Twitter
            </a>
          </li>
        <?php endif; ?>
        <?php if ($setting->get('app.socials.github')) : ?>
          <li>
            <a href="<?= $setting->get('app.socials.github') ?>" class="btn btn-github btn-github sharrre btn-round" rel="tooltip" title="Star on Github">
              <i class="fa fa-github"></i> Github
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
    <div class="credits ml-auto">
      <span class="copyright">
        &copy; 2021, made with <i class="fa fa-heart heart"></i> by Christopher Kelly & Jibao Mansaray.
      </span>
    </div>
  </div>
</div>