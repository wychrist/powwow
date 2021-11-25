<!-- Navbar -->
<nav class="navbar navbar-expand-lg fixed-top navbar-transparent bg-default" color-on-scroll="200">
  <div class="container">
    <div class="navbar-translate">
      <a class="navbar-brand" href="./" rel="tooltip" title=<?= $page->title ?> data-placement="bottom" target="_blank">
        <?= $page->title ?>
      </a>
      <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-bar bar1"></span>
        <span class="navbar-toggler-bar bar2"></span>
        <span class="navbar-toggler-bar bar3"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse justify-content-end" id="navigation">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="./" class="nav-link" rel="tooltip" title="Homepage" data-placement="bottom" target="_blank">
            <p>Home</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="./about-us" class="nav-link" rel="tooltip" title="About Us" data-placement="bottom" target="_blank">
            <p>About Us</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="./contact-us" class="nav-link" rel="tooltip" title="Contact Us" data-placement="bottom" target="_blank">
            <p>Contact Us</p>
          </a>
        </li>
        <?php if ($page->facebook) : ?>
          <li class="nav-item">
            <a href="<?= $page->facebook ?>" class="btn btn-facebook-bg facebook-sharrre btn-round" rel="tooltip" title="Like us on Facebook!">
              <i class="fa fa-facebook-square"></i>
            </a>
          </li>
        <?php endif; ?>
        <?php if ($page->twitter) : ?>
          <li class="nav-item">
            <a href="<?= $page->twitter ?>" class="btn btn-twitter-bg twitter-sharrre btn-round" rel="tooltip" title="Tweet!">
              <i class="fa fa-twitter"></i>
            </a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->
<div class="page-header section-dark" style="background-image: url(<?= $page->image ?>)">
  <div class="filter"></div>
  <div class="content-center">
    <div class="container">
      <div class="title-brand">
        <h1 class="presentation-title"><?= $page->title ?></h1>
      </div>
      <h2 class="presentation-subtitle text-center"><?= $page->subtitle ?></h2>
    </div>
  </div>
</div>