<!DOCTYPE html>
<html lang="en">

<head>
  @include('theme_section::header_css')
</head>

<body class="index-page sidebar-collapse">

  @include('theme_section::header')

  <div class="main wrapper">
    <div class='section section-brown'>
      <div class="container" style="margin-top: 150px">
        <h1 class="text-center title">
          Thank you for validating your email address
        </h1>
        <p class='button-flex-box'>
          <a class="no-margin btn btn-danger btn-move-right btn-round" href="/">
            Home
            <i class="nc-icon nc-minimal-right"></i>
          </a>
        </p>
      </div>
    </div>

    <footer class="section-dark footer footer-black">
      @include('theme_section::footer')
    </footer>

    @include('theme_section::footer_js')

</body>

</html>