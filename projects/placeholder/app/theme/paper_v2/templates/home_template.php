<?php
$page->facebook = $this->settings('socials.facebook');
$page->google = $this->settings('socials.google');
$page->twitter = $this->settings('socials.twitter');
$page->github = $this->settings('socials.github');
$page->email = $this->settings('socials.email');

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