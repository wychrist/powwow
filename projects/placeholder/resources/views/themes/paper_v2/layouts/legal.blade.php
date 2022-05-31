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
  @include('theme_section::header_css')
</head>

<body class="index-page sidebar-collapse">

  @include('theme_section::header')

  <div class="main wrapper">
    <div class="section section-brown">
      <div class="contact-us-gap"></div>
      @yield('content')
    </div>

    <footer class="section-dark footer footer-black">
      @include('theme_section::footer')
    </footer>

    @include('theme_section::footer_js')

</body>

</html>