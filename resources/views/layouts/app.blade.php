<!DOCTYPE html>
<html lang="vi">

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">

  <title>@yield('title', 'Giftos')</title>

  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}" />
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
</head>

<body>
  <div class="hero_area">
    <!-- Header Section -->
    <header class="header_section">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="{{ url('/') }}">
          <span>Giftos</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('shop.index') }}">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('shop.shop') }}">Shop</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('shop.why') }}">Why Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('shop.testimonial') }}">Testimonial</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('shop.contact') }}">Contact Us</a>
            </li>
          </ul>
          <div class="user_option">
            <a href="{{ route('login') }}">
              <i class="fa fa-user" aria-hidden="true"></i>
              <span>Login</span>
            </a>
            <a href="#">
              <i class="fa fa-shopping-bag" aria-hidden="true"></i>
            </a>
            <form class="form-inline">
              <button class="btn nav_search-btn" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
              </button>
            </form>
          </div>
        </div>
      </nav>
    </header>
    <!-- End Header Section -->

    <!-- Main Content Section -->
    @yield('content')

    <!-- Footer Section -->
    <section class="info_section layout_padding2-top">
      <div class="social_container">
        <div class="social_box">
          <a href="#">
            <i class="fa fa-facebook" aria-hidden="true"></i>
          </a>
          <a href="#">
            <i class="fa fa-twitter" aria-hidden="true"></i>
          </a>
          <a href="#">
            <i class="fa fa-instagram" aria-hidden="true"></i>
          </a>
          <a href="#">
            <i class="fa fa-youtube" aria-hidden="true"></i>
          </a>
        </div>
      </div>
      <div class="info_container">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-lg-3">
              <h6>ABOUT US</h6>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
            </div>
            <div class="col-md-6 col-lg-3">
              <div class="info_form">
                <h5>Newsletter</h5>
                <form action="#">
                  <input type="email" placeholder="Enter your email">
                  <button>Subscribe</button>
                </form>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <h6>NEED HELP</h6>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
            </div>
            <div class="col-md-6 col-lg-3">
              <h6>CONTACT US</h6>
              <div class="info_link-box">
                <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> Gb road 123 london Uk </a>
                <a href="#"><i class="fa fa-phone" aria-hidden="true"></i> +01 12345678901 </a>
                <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> demo@gmail.com </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer_section">
        <div class="container">
          <p>&copy; <span id="displayYear"></span> All Rights Reserved By <a href="https://html.design/">Free Html Templates</a></p>
        </div>
      </footer>
    </section>
    <!-- End Footer Section -->

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      document.getElementById("displayYear").innerText = new Date().getFullYear();
    </script>
</body>
</html>
