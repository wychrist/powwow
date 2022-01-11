<!--
=========================================================
* Paper Kit Pro - v2.3.1
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-kit-2-pro
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->

<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->insert('sections/header_css', compact('page')) ?>
  <!-- CSS Just for demo purpose, don't include it in your project
  <link href="/assets/paper_theme_v2/demo/demo.css" rel="stylesheet" />
  -->
</head>

<body class="index-page sidebar-collapse">

  <?php $this->insert('sections/header', compact('page')) ?>


  <div class="main wrapper">

    <?php if ($this->section('section1')) : ?>
      <div class='section section-nude'>
        <?= $this->section('section1'); ?>
      </div>
    <?php endif; ?>

    <?php if ($this->section('section2')) : ?>
      <div class='section section-gold'>
        <?= $this->section('section2'); ?>
      </div>
    <?php endif; ?>

    <?php if ($this->section('section3')) : ?>
      <div class='section section-gray'>
        <?= $this->section('section3'); ?>
      </div>
    <?php endif; ?>

    <?php if ($this->section('section4')) : ?>
      <div class='section section-brown'>
        <?= $this->section('section4'); ?>
      </div>
    <?php endif; ?>

    <?php if ($this->section('section5')) : ?>
      <div class='section section-dark-blue'>
        <?= $this->section('section5'); ?>
      </div>
    <?php endif; ?>

    <?php if ($this->section('section6')) : ?>
      <div class='section section-light-blue'>
        <?= $this->section('section6'); ?>
      </div>
    <?php endif; ?>


    <footer class="section-dark footer footer-black">
      <?php $this->insert('sections/footer', compact('page')) ?>
    </footer>

    <?php $this->insert('sections/footer_js', compact('page')) ?>

</body>

</html>