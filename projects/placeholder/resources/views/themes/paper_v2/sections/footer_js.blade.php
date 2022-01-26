<!--   Core JS Files   -->
<script src="/assets/paper_theme_v2/js/core/jquery.min.js" type="text/javascript"></script>
<script src="/assets/paper_theme_v2/js/core/popper.min.js" type="text/javascript"></script>
<script src="/assets/paper_theme_v2/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="/assets/paper_theme_v2/js/plugins/bootstrap-switch.js"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="/assets/paper_theme_v2/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="/assets/paper_theme_v2/js/plugins/moment.min.js"></script><!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
<script src="/assets/paper_theme_v2/js/plugins/bootstrap-tagsinput.js"></script>
<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
<script src="/assets/paper_theme_v2/js/plugins/bootstrap-selectpicker.js" type="text/javascript"></script>
<!--	Plugin for Datetimepicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
<script src="/assets/paper_theme_v2/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--  Plugin for presentation page - isometric cards  -->
<script src="/assets/paper_theme_v2/js/plugins/presentation-page/main.js"></script>
<!--  Vertical nav - dots -->
<script src="/assets/paper_theme_v2/demo//vertical-nav.js" type="text/javascript"></script>
<!--  Photoswipe files -->
<script src="/assets/paper_theme_v2/js/plugins/photo_swipe/photoswipe.min.js"></script>
<script src="/assets/paper_theme_v2/js/plugins/photo_swipe/photoswipe-ui-default.min.js"></script>
<script src="/assets/paper_theme_v2/js/plugins/photo_swipe/init-gallery.js"></script>
<!--  for Jasny fileupload -->
<script src="/assets/paper_theme_v2/js/plugins/jasny-bootstrap.min.js"></script>
<!-- Control Center for Paper Kit: parallax effects, scripts for the example pages etc -->
<script src="/assets/paper_theme_v2/js/paper-kit.js?v=2.3.1" type="text/javascript"></script>
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

    if (window_width >= 768) {
      $(window).on('scroll', pk.checkScrollForPresentationPage);
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
