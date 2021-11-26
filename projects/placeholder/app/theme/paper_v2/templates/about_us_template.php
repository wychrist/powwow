<?php
$page->facebook = $this->settings('socials.facebook');
$page->google = $this->settings('socials.google');
$page->twitter = $this->settings('socials.twitter');
$page->github = $this->settings('socials.github');
$page->email = $this->settings('socials.email');

$this->layout('layouts/landing', compact('page')) ?>


<?php $this->start('section1'); ?>
<div class="container">
  <h1>Who we are</h1>
  <div class="row">
    <img class="col-md-6" style="padding: 15 px;" src="./assets/img/worship_hall_1.webp" alt="Worship at Wyreema Hall">
    <div class="col-md-6">
      <p> We are a non-denomination christian church that meets at a Wyreema Community Hall every Sunday morning for worship and Thursday night for bible study. Our Sunday worship is a capella Church of Christ style.
      </p>
    </div>
    <div class="row">
      <div class="col-md-6">
        <p> Paragraph 2
        </p>
      </div>
      <img class="col-md-6" style="padding: 15 px;" src="./assets/img/worship_hall_2.webp" alt="Worship at Wyreema Hall">
    </div>
  </div>
</div>
<?php $this->stop(); ?>

<?php
$this->start('section2');
$this->insert('sections/elders');
$this->stop();
?>

<?php $this->start('section3'); ?>
<div class="container">
  <h1>Community Involvement</h1>
  <div class="row">
    <img class="col-md-6" style="padding: 15 px;" src="./assets/img/placeholder.jpg" alt="Community Involvement - Tony's Kitchen">
    <div class="col-md-6">
      <h2 class='text-center'>Tony's Kitchen</h2>
      <p> Blankets and jumpers for teh homeless
      </p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <h2 class='text-center'>Operation Christmas Child</h2>
      <p> Paragraph 2
      </p>
    </div>
    <img class="col-md-6" style="padding: 15 px;" src="./assets/img/Operation_christmas_Child.jpg" alt="Community Involvement - Operation Christmas Child">
  </div>
</div>
<?php $this->stop(); ?>

<?php $this->start('section4'); ?>
<div class="container">
  <h1>History</h1>
  <div class="row">
    <img class="col-md-6" style="padding: 15 px;" src="./assets/img/worship_home_1.jpg" alt="Community Involvement">
    <div class="col-md-6">
      <h2 class='text-center'>Worshiping in homes</h2>
      <p> worshiping in homes
      </p>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <h2 class='text-center'>Worshiping in the hall</h2>
      <p> worshiping in the hall
      </p>
    </div>
    <img class="col-md-6" style="padding: 15 px;" src="./assets/img/worship_hall_3.jpg" alt="Community Involvement 2">
  </div>
</div>
<?php $this->stop(); ?>

<b>Body content</b>