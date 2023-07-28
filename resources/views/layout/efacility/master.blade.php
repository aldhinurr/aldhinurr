<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="author" content="TechyDevs" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>e-Facility ITB</title>
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('efacility/images/favicon.jpeg') }}" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
    rel="stylesheet" />

  <!-- Template CSS Files -->
  <link rel="stylesheet" href="{{ asset('efacility/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('efacility/css/bootstrap-select.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('efacility/css/line-awesome.css') }}" />
  <link rel="stylesheet" href="{{ asset('efacility/css/owl.carousel.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('efacility/css/owl.theme.default.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('efacility/css/jquery.fancybox.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('efacility/css/daterangepicker.css') }}" />
  <link rel="stylesheet" href="{{ asset('efacility/css/animated-headline.css') }}" />
  <link rel="stylesheet" href="{{ asset('efacility/css/jquery-ui.css') }}" />
  <link rel="stylesheet" href="{{ asset('efacility/css/flag-icon.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('efacility/css/select2.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('efacility/css/select2-bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('efacility/css/style.css') }}" />

  @yield('styles')
</head>

<body>
  <!-- start cssload-loader -->
  <div class="preloader" id="preloader">
    <div class="loader">
      <svg class="spinner" viewBox="0 0 50 50">
        <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
      </svg>
    </div>
  </div>
  <!-- end cssload-loader -->

  <!-- ================================
            START HEADER AREA
================================= -->
  @include('layout.efacility.header._base')
  <!-- ================================
        END HEADER AREA
================================= -->

  @yield('content')

  @include('layout.efacility._footer')

  @include('layout.efacility._scrolltop')

  @include('layout.efacility.partials.modals._base')

  <!-- Template JS Files -->
  <script src="{{ asset('efacility/js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('efacility/js/jquery-ui.js') }}"></script>
  <script src="{{ asset('efacility/js/popper.min.js') }}"></script>
  <script src="{{ asset('efacility/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('efacility/js/bootstrap-select.min.js') }}"></script>
  <script src="{{ asset('efacility/js/moment.min.js') }}"></script>
  <script src="{{ asset('efacility/js/daterangepicker.js') }}"></script>
  <script src="{{ asset('efacility/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('efacility/js/jquery.fancybox.min.js') }}"></script>
  <script src="{{ asset('efacility/js/jquery.countTo.min.js') }}"></script>
  <script src="{{ asset('efacility/js/animated-headline.js') }}"></script>
  <script src="{{ asset('efacility/js/jquery.ripples-min.js') }}"></script>
  <script src="{{ asset('efacility/js/quantity-input.js') }}"></script>
  <script src="{{ asset('efacility/js/jquery.superslides.min.js') }}"></script>
  <script src="{{ asset('efacility/js/superslider-script.js') }}"></script>
  <script src="{{ asset('efacility/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('efacility/js/main.js') }}"></script>

  @yield('scripts')
</body>

</html>
