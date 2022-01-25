<?php

use App\Cms\Page;

$page = (isset($page)) ? $page : new Page(); // fall back to a blank page
?>
<?php $this->layout('layouts/two_columns', compact('page')) ?>

<?php $this->start('header')?>
Header stuff goes here
<?php $this->stop()?>

<?php $this->start('right')?>
Header stuff goes here
<?php $this->stop()?>

<b>Body content</b>
