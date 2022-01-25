
<?php

use App\Cms\Page;

$page = (isset($page)) ? $page : new Page(); // fall back to a blank page
?>

<!DOCTYPE html>
<html lang="en">

<head>
     <?php $this->insert('sections/header_css', compact('page')) ?>
</head>

<body>
  <div style="background-color: blue;">
     <?php $this->insert('sections/header') ?>
    <?=$this->section('header'); ?>
  </div>

  <div style="background-color: green;">
    Side bar
    <?=$this->section('right_sidebar'); ?>
  </div>

  <div style="background-color: red;">
    <?=$this->section('content'); ?>
  </div>

  <div style="background-color: pink;">
     <?php $this->insert('sections/footer') ?>
  </div>
</body>
