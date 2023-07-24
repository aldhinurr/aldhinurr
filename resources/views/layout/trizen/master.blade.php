<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="author" content="TechyDevs" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Trizen - Travel Booking HTML Template</title>
  <!-- Favicon -->
  <link rel="icon" href="images/favicon.png" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
    rel="stylesheet" />

  <!-- Template CSS Files -->
  <link rel="stylesheet" href="{{ asset('trizen/css/bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('trizen/css/bootstrap-select.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('trizen/css/line-awesome.css') }}" />
  <link rel="stylesheet" href="{{ asset('trizen/css/owl.carousel.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('trizen/css/owl.theme.default.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('trizen/css/jquery.fancybox.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('trizen/css/daterangepicker.css') }}" />
  <link rel="stylesheet" href="{{ asset('trizen/css/animated-headline.css') }}" />
  <link rel="stylesheet" href="{{ asset('trizen/css/jquery-ui.css') }}" />
  <link rel="stylesheet" href="{{ asset('trizen/css/flag-icon.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('trizen/css/select2.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('trizen/css/select2-bootstrap.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('trizen/css/style.css') }}" />

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
  @include('layout.trizen.header._base')
  <!-- ================================
        END HEADER AREA
================================= -->

  @yield('content')

  @include('layout.trizen._footer')

  @include('layout.trizen._scrolltop')

  @include('layout.trizen.partials.modals._base')

  <!-- Template JS Files -->
  <script src="{{ asset('trizen/js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('trizen/js/jquery-ui.js') }}"></script>
  <script src="{{ asset('trizen/js/popper.min.js') }}"></script>
  <script src="{{ asset('trizen/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('trizen/js/bootstrap-select.min.js') }}"></script>
  <script src="{{ asset('trizen/js/moment.min.js') }}"></script>
  <script src="{{ asset('trizen/js/daterangepicker.js') }}"></script>
  <script src="{{ asset('trizen/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('trizen/js/jquery.fancybox.min.js') }}"></script>
  <script src="{{ asset('trizen/js/jquery.countTo.min.js') }}"></script>
  <script src="{{ asset('trizen/js/animated-headline.js') }}"></script>
  <script src="{{ asset('trizen/js/jquery.ripples-min.js') }}"></script>
  <script src="{{ asset('trizen/js/quantity-input.js') }}"></script>
  <script src="{{ asset('trizen/js/jquery.superslides.min.js') }}"></script>
  <script src="{{ asset('trizen/js/superslider-script.js') }}"></script>
  <script src="{{ asset('trizen/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('trizen/js/main.js') }}"></script>

  @yield('scripts')
</body>

</html>
