<?php
$setting = app('Modules\CongregateContract\Setting\SettingInterface');

// @todo source this from settings or somewhere !?!?!
$legalUrl = \Modules\CongregateCms\Services\Url::page('legal');
$incUrl = \Modules\CongregateCms\Services\Url::page('incorporation');
$privacyUrl = \Modules\CongregateCms\Services\Url::page('privacy');
?>
<div class="row">
  <div class="navbar-buffer"></div>
  <div class="navbar-buffer-centre">
    <div class="row">
      <div class="col-12 footer-top">
      </div>
    </div>
    <div class="row row-cols-1 row-cols-xl-4">

      <div class="col-xl-3 px-sm-4">
        <h3 class="text-center no-margin">Contact Us</h3>
        <div class="row ">
          <div class="col">
            <div class="footer-nav-item footer-socials">
              <a href="/contact-us" class="btn btn-danger btn-round nav-link contact-us-button-footer">
                <i class="fa fa-envelope" aria-hidden="true"></i> Contact Us
              </a>
            </div>
            <form class="footer-nav-item" method="POST" action="{{ route('newsletter_subscribe') }}">
              @csrf
              <div class="input-group input-group-footer">
                <label for="subscribe_email" class="footer-subscribe-label">Subscribe to our Newsletter:</label>
              </div>
              <div class="input-group input-group-footer">
                <div class="input-group-prepend">
                  <span class="input-group-text input-prepend-for-icon">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                  </span>
                </div>
                <input required type="email" name="subscribe_email" placeholder="john.doe@example.com" class="form-control footer-subscribe-field" aria-label="user email input for subscribe form" id="subscribe_email">
              </div>
              <div class="form-check form-check-inline">
                <label class="form-check-label" for="consent_footer" data-toggle="tooltip" data-placement="bottom" data-original-title="Consent to Privacy Policy">
                  <input class="form-check-input" type="checkbox" name="consent_footer" value="" alt="Consent to Privacy Policy" aria-label="Consent to Privacy Policy" required id="consent_footer">
                  Consent to
                  <span class="form-check-sign"></span>
                </label>
                <a class="privacy-policy-padding" href="{{ $privacyUrl }}"> Privacy Policy</a>
              </div>

              <div class="input-group input-group-footer">
                <button class="btn btn-danger btn-round" type="submit" alt="Subscribe Button"> Subscribe </button>
              </div>
            </form>
            <div class="row">
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
      <div class="col-xl-3 footer-black-right-col px-sm-4">
        <h3 class="text-center no-margin">Come for a Visit</h3>
        <p class="footer-nav-item text-center">Worship 9:30 am Sundays at the Wyreema Community Hall. Corner of Umbiram Rd and Margetts St., Wyreema QLD 4352.</p>
      </div>
      <div class="col-xl-3 footer-black-right-col px-sm-4">
        <h3 class="text-center no-margin">Get Directions</h3>
        <a class="" href="https://goo.gl/maps/EgBaegpyNs71vFzm8" rel="tooltip" target="_blank">
          <p class="nav-link text-center">Click below for Google Maps.</p>
          <img class="card-image footer-map-image" src="/assets/paper_theme_v2/img/wyreema-community-hall-small.webp" alt="Wyreema Community Hall">
          <img class="card-image footer-map-image" src="/assets/paper_theme_v2/img/google-map-hall.webp" alt="Google Map Wyreema Community Hall">
          <p class="nav-link footer-map-attribution">Map data: Google, &copy;2022</p>
        </a>
      </div>
      <div class="col-xl-3 footer-black-right-col px-sm-4">

        <h3 class="text-center no-margin">Legal</h3>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" href="{{ $legalUrl }}">Legal Details</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ $incUrl }}">Incorporation Details</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ $privacyUrl }}">Privacy Policy</a>
          </li>
        </ul>
      </div>
    </div>

    <div class="row">

      <div class="credits ml-auto">
        <span class="copyright">
          &copy; <?= date('Y') ?>, made by C. Kelly & J. Mansaray.
        </span>
      </div>
    </div>
  </div>
  <div class="navbar-buffer"></div>
</div>