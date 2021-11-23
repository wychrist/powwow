<!DOCTYPE html>
<head>

     <?php $this->insert('sections/header_css') ?>
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
