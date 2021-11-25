<!--
=========================================================
 Paper Kit 2 - v2.2.0
=========================================================

 Product Page: https://www.creative-tim.com/product/paper-kit-2
 Copyright 2019 Creative Tim (https://www.creative-tim.com)
 Licensed under MIT (https://github.com/creativetimofficial/paper-kit-2/blob/master/LICENSE.md)

 Coded by Creative Tim

=========================================================

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->

<?php
$page->elder_section = render_template('fragment/elders');
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <?php $this->insert('sections/header_css', compact('page')) ?>
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="/assets/paper_theme_v2/demo/demo.css" rel="stylesheet" />
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

    <!--   Core JS Files   -->
    <script src="./assets/paper_theme_v2/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="./assets/paper_theme_v2/js/core/popper.min.js" type="text/javascript"></script>
    <script src="./assets/paper_theme_v2/js/core/bootstrap.min.js" type="text/javascript"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="./assets/paper_theme_v2/js/plugins/bootstrap-switch.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="./assets/paper_theme_v2/js/plugins/nouislider.min.js" type="text/javascript"></script>
    <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
    <script src="./assets/paper_theme_v2/js/plugins/moment.min.js"></script>
    <script src="./assets/paper_theme_v2/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Control Center for Paper Kit: parallax effects, scripts for the example pages etc -->
    <script src="./assets/paper_theme_v2/js/paper-kit.js?v=2.2.0" type="text/javascript"></script>
    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <script>
      $(document).ready(function() {

        if ($("#datetimepicker").length != 0) {
          $('#datetimepicker').datetimepicker({
            icons: {
              time: "fa fa-clock-o",
              date: "fa fa-calendar",
              up: "fa fa-chevron-up",
              down: "fa fa-chevron-down",
              previous: 'fa fa-chevron-left',
              next: 'fa fa-chevron-right',
              today: 'fa fa-screenshot',
              clear: 'fa fa-trash',
              close: 'fa fa-remove'
            }
          });
        }

        function scrollToDownload() {

          if ($('.section-download').length != 0) {
            $("html, body").animate({
              scrollTop: $('.section-download').offset().top
            }, 1000);
          }
        }
      });
    </script>
</body>

</html>