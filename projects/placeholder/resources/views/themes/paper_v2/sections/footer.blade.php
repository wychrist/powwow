<?php
$setting = app('Modules\CongregateContract\Setting\SettingInterface');
//flex-column d-flex
?>
<div class="row">
  <div class="col-1"></div>
  <div class="col-10">
    <div class=" row">
      <div class="col-12" style="height: 50px;">
      </div>
    </div>
    <div class="row row-cols-1 row-cols-xl-3">

      <div class="col-xl-4 footer-black-left-col px-sm-4">
        <h2 class="text-center no-margin">Contact Us</h2>
        <div class="row ">
          <div class="col">
            <div class="footer-nav-item footer-socials">
              <a href="/contact-us" class="btn btn-danger btn-round nav-link" style="width: fit-content;">
                <i class="fa fa-envelope" aria-hidden="true"></i> Contact Us
              </a>
            </div>
            <div class="row row-cols-1">
              <?php if ($setting->get('app.socials.facebook')) : ?>
                <div class="col footer-nav-item footer-socials">
                  <a href="<?= $setting->get('app.socials.facebook') ?>" class="btn footer-socials-icon btn-facebook" rel=" tooltip" title="Like us on Facebook!">
                    <i class="fa fa-facebook"></i>
                  </a>
                </div>
              <?php endif; ?>
              <?php if ($setting->get('app.socials.youtube')) : ?>
                <div class="col footer-nav-item footer-socials">
                  <a href="<?= $setting->get('app.socials.youtube') ?>" class="btn footer-socials-icon btn-youtube" rel="tooltip" title="Youtube">
                    <i class="fa fa-youtube"></i>
                  </a>
                </div>
              <?php endif; ?>
              <?php if ($setting->get('app.socials.twitter')) : ?>
                <div class="col footer-nav-item footer-socials">
                  <a href="<?= $setting->get('app.socials.twitter') ?>" class="btn footer-socials-icon btn-twitter" rel="tooltip" title="Tweet!">
                    <i class="fa fa-twitter"></i>
                  </a>
                </div>
              <?php endif; ?>
              <?php if ($setting->get('app.socials.instagram')) : ?>
                <div class="col footer-nav-item footer-socials">
                  <a href="<?= $setting->get('app.socials.instagram') ?>" class="btn footer-socials-icon btn-instagram" rel="tooltip" title="Instagram">
                    <i class="fa fa-instagram"></i>
                  </a>
                </div>
              <?php endif; ?>
              <?php if ($setting->get('app.socials.github')) : ?>
                <div class="col footer-nav-item footer-socials">
                  <a href="<?= $setting->get('app.socials.github') ?>" class="btn footer-socials-icon btn-github" rel="tooltip" title="Star on Github">
                    <i class="fa fa-github"></i>
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-4 px-sm-4">
        <h2 class="text-center no-margin">Come for a visit</h2>
        <p class="footer-nav-item text-center">9:30 am Sundays at the Wyreema Community Hall</p>
        <a class="" href="https://goo.gl/maps/EgBaegpyNs71vFzm8" rel="tooltip">
          <img class="card-image" style="width: 100%" src="/assets/paper_theme_v2/img/wyreema-community-hall-small.webp" alt="Wyreema Community Hall">
          <img class="card-image" style="width: 100%" src="/assets/paper_theme_v2/img/google-map-hall.webp" alt="Google Map Wyreema Community Hall">
          <p class="nav-link" style="font-size: 0.8rem;">Map data: Google, &copy;2022</p>
        </a>

      </div>
      <div class="col-xl-4 footer-black-right-col px-sm-4">
        <h2 class="text-center no-margin">Legal</h2>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="/pages/legal">Legal Details</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/pages/incorporation">Incorporation Details</a>
          </li>
        </ul>
      </div>
    </div>

    <div class="row">

      <div class="credits ml-auto">
        <span class="copyright">
          &copy; <?=date('Y') ?>, made by C. Kelly & J. Mansaray.
        </span>
      </div>
    </div>
  </div>
  <div class="col-1"></div>
</div>
