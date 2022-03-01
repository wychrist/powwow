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
  <!-- CSS Just for demo purpose, don't include it in your project
  <link href="/assets/paper_theme_v2/demo/demo.css" rel="stylesheet" />
  -->
</head>

<body class="index-page sidebar-collapse">

  @include('theme_section::header')

  <div class="main wrapper">

    @hasSection('content')
    <div class='section section-nude container'>
      @yield('content')
    </div>
    @endif

    @hasSection('section1')
    <div class='section section-nude'>
      @yield('section1')
    </div>
    @endif

    @hasSection('section2')
    <div class='section section-brown'>
      @yield('section2')
    </div>
    @endif

    @hasSection('section3')
    <div class='section section-gray'>
      @yield('section3')
    </div>
    @endif

    @hasSection('section4')
    <div class='section section-brown'>
      @yield('section4')
    </div>
    @endif

    @hasSection('section5')
    <div class='section section-gold'>
      @yield('section5')
    </div>
    @endif

    @hasSection('section6')
    <div class='section section-dark-blue'>
      @yield('section6')
    </div>
    @endif

    <footer class="section-dark footer footer-black">
      @include('theme_section::footer')
    </footer>

    @include('theme_section::footer_js')

</body>

</html>