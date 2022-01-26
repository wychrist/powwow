<div class="container">
  <h1 class="title"><?= $page->title ?></h1>
  <?php if ($page->children) : ?>
    <?php foreach ($page->children as $index => $child) :  ?>
      <?php if ($index == 0) :  ?>
        <div class="card card-plain card-blog">
          <div class="row">
            <div class="col-md-6">
              <img class="card card-image" style="padding: 15 px;" src="<?= $child->image ?>" alt="Worship at Wyreema Hall">
            </div>
            <div class="col-md-6">
              <div class='card-body'>
                <?php if ($child->title) : ?>
                  <h2 class='card-title'><?= $child->title ?></h2>
                <?php endif; ?>
                <p class='card-description'><?= $child->content ?></p>
              </div>
            </div>
          </div>
        </div>
      <?php else : ?>
        <div class="card card-plain card-blog">
          <div class="row">
            <div class="col-md-6">
              <div class='card-body'>
                <?php if ($child->title) : ?>
                  <h2 class='card-title'><?= $child->title ?></h2>
                <?php endif; ?>
                <p class='card-description'><?= $child->content ?></p>
              </div>
            </div>
            <div class="col-md-6">
              <img class="card card-image" style="padding: 15 px;" src="<?= $child->image ?>" alt="Worship at Wyreema Hall">
            </div>
          </div>
        </div>

      <?php endif; ?>

    <?php endforeach  ?>
  <?php endif ?>
</div>
