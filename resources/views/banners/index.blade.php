<!DOCTYPE html>
<html>

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
  <link rel="shortcut icon" href="../../images/favicon.png" type="image/x-icon">

  <title>
    Giftos
  </title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css" />

  <!-- Custom styles for this template -->
  <link href="../../css/style.css" rel="stylesheet">
  <!-- responsive style -->
  <link href="../../css/responsive.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/banner.css') }}">
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
   <div class="hero_area">
    <header class="header_section">
      <nav class="navbar navbar-expand-lg custom_nav-container ">
        <a class="navbar-brand" href="{{ route('home') }}">
          <span>
            Giftos
          </span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class=""></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav  ">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('home') }}">Home
            </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('shop') }}">
                Shop

              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('why') }}">
                Why Us
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('testimonial') }}">
                Testimonial
              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="{{ route('contact') }}">
                Contact Us                 <span class="sr-only">(current)</span>

            </a>
            </li>
          </ul>
          <div class="user_option">
            <a href="{{ route('login') }}">
                <i class="fa fa-user" aria-hidden="true"></i>
              <span>
                Login
              </span>
            </a>
            <a href="">
              <i class="fa fa-shopping-bag" aria-hidden="true"></i>
            </a>
            <form class="form-inline ">
              <button class="btn nav_search-btn" type="submit">
                <i class="fa fa-search" aria-hidden="true"></i>
              </button>
            </form>
          </div>
        </div>
      </nav>
    </header>


@if(session('success'))
    <p>{{ session('success') }}</p>
@endif
<div class="container">
    <h1>Danh sách Banner</h1>
    <a href="{{ route('banners.create') }}" class="btn">Thêm Banner</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Hình ảnh</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($banners as $banner)
            <tr>
                <td>{{ $banner->id }}</td>
                <td>{{ $banner->title }}</td>
                <td>
                    <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}" class="banner-preview">
                </td>
                <td>{{ $banner->is_active ? 'Hoạt động' : 'Không hoạt động' }}</td>
                <td>
                    <a href="{{ route('banners.edit', $banner) }}" class="btn">Chỉnh sửa</a>
                    <form action="{{ route('banners.destroy', $banner) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
