<?php
$page->facebook = $this->settings('app.socials.facebook');
$page->google = $this->settings('app.socials.google');
$page->twitter = $this->settings('app.socials.twitter');
$page->github = $this->settings('app.socials.github');
$page->email = $this->settings('app.socials.email');

$this->layout('layouts/landing', compact('page')) ?>


<?php
$this->start('section1');
$this->insert('sections/meetings');
$this->stop();
?>

<?php
$this->start('section2');
$this->insert('sections/meetings');
$this->stop();
?>

<?php
$this->start('section3');
$this->insert('sections/meetings');
$this->stop();
?>

<?php
$this->start('section4');
$this->insert('sections/meetings');
$this->stop();
?>

<b>Body content</b>
