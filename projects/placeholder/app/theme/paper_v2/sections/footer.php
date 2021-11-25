<div class="container">
  <?php if ($page->email) : ?>
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <h2 class="text-center">Contact Us:</h2>
      </div>
      <div class="col-md-3"></div>
    </div>
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-6">
        <a href="mailto:<?= $page->email ?>">
          <h3 class="text-center">
            <?= $page->email ?></h3>
        </a>
      </div>
      <div class="col-md-3"></div>
    </div>
  <?php endif; ?>
  <div class="row">
    <nav class="footer-nav">
      <ul>
        <?php if ($page->facebook) : ?>
          <li class="nav-item">
            <a href="<?= $page->facebook ?>" class="btn btn-facebook-bg facebook-sharrre btn-round" rel="tooltip" title="Like us on Facebook!">
              <i class="fa fa-facebook-square"></i> Facebook
            </a>
          </li>
        <?php endif; ?>
        <?php if ($page->twitter) : ?>
          <li class="nav-item">
            <a href="<?= $page->twitter ?>" class="btn btn-twitter-bg twitter-sharrre btn-round" rel="tooltip" title="Tweet!">
              <i class="fa fa-twitter"></i> Twitter
            </a>
          </li>
        <?php endif; ?>
        <?php if ($page->github) : ?>
          <li>
            <a href="<?= $page->github ?>" class="btn btn-github-bg btn-github sharrre btn-round" rel="tooltip" title="Star on Github">
              <i class="fa fa-github"></i> Github
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
    <div class="credits ml-auto">
      <span class="copyright">
        © 2021, made with <i class="fa fa-heart heart"></i> by Christopher & Jibao Mansaray.
      </span>
    </div>
  </div>
</div>