<?php
$setting = app('Modules\CongregateContract\Setting\SettingInterface');
//flex-column d-flex
?>
<div class="row">
  <div class="navbar-buffer"></div>
  <div class="navbar-buffer-centre">
    <?php if ($setting->get('app.contact.email')) : ?>
      <div class=" row">
        <div class="col-12" style="height: 50px;">
        </div>
      </div>
      <div class="row">

        <div class="col-lg-4 footer-black-left-col px-sm-4">
          <h2 class="text-center no-margin">Contact Us</h2>
          <div class="row ">
            <div class="col">
              <div class="footer-nav-item text-center">
                <a class="nav-link" href=" mailto:<?= $setting->get('app.contact.email') ?>">
                  <?= $setting->get('app.contact.email') ?>
                </a>
              </div>
              <div class="row row-cols-2">
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
        <div class="col-lg-4 px-sm-4">
          <h2 class="text-center no-margin">Come for a visit</h2>
          <p class="footer-nav-item text-center">9:30 am Sundays at the Wyreema Community Hall</p>
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d949.6407255835479!2d151.85567642799563!3d-27.656602834335718!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b964f902b9e70fb%3A0x6005a22abcb17bc4!2sWyreema%20Hall!5e0!3m2!1sen!2sau!4v1637761022483!5m2!1sen!2sau" height="450" style="border:0; width:100%;" class="footer-nav-item" allowfullscreen="" loading="lazy">
          </iframe>
        </div>
        <div class="col-lg-4 footer-black-right-col px-sm-4">
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

    <?php endif; ?>
    <div class="row">

      <div class="credits ml-auto">
        <span class="copyright">
          &copy; 2022, made by C. Kelly & J. Mansaray.
        </span>
      </div>
    </div>
  </div>
  <div class="navbar-buffer"></div>
</div>