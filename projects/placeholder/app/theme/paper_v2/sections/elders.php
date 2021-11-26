<?php
$maxColumns = 4;
$elders = $this->get_data('list_of_elders');
$numElders = sizeof($elders);

?>

<div class="container">
  <h1 class="text-center">Elders</h1>
  <div class="row">
    <?php foreach ($elders as $elder) : ?>
      <div class="col-md-6">
        <div class="card card-profile">
          <div class="card-body">
            <div class="card-avatar">
              <img src="<?= $elder['image'] ?>" alt="Photo of <?= $elder['name'] ?>">
            </div>
            <div class="card-body">
              <div class="author">
                <h4 class="card-title"><?= $elder['name'] ?></h4>
                <?php if ($elder['office']) : ?>
                  <h6 class="card-category"><?= $elder['office'] ?></h6>
                <?php else : ?>
                  <h6 class="card-category">Elder</h6>
                <?php endif; ?>
              </div>
              <p class="card-description text-center">
                <?= $elder['bio'] ?>
              </p>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>