<?php 
$page->facebook = $this->settings('socials.facebook');
$page->google = $this->settings('socials.google');
$page->twitter = $this->settings('socials.twitter');

$this->layout('layouts/main', compact('page')) ?>


<?php $this->start('right')?>
Right stuff goes here
<?php $this->stop()?>

<b>Body content</b>