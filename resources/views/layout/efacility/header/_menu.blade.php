<div class="header-menu-wrapper padding-right-100px padding-left-100px">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="menu-wrapper">
          <a href="#" class="down-button"><i class="la la-angle-down"></i></a>
          <div class="logo">
            <a href="{{ route('website.index') }}"><img src="{{ asset('efacility/images/logo-putih.jpeg') }}" alt="logo" /></a>
            <div class="menu-toggler">
              <i class="la la-bars"></i>
              <i class="la la-times"></i>
            </div>
            <!-- end menu-toggler -->
          </div>
          <!-- end logo -->
          <div class="main-menu-content">
            <nav>
              <ul>
                <li>
                  <a href="{{ route('website.index') }}">Beranda</a>
                </li>
                <li>
                  <a href="#">Layanan <i class="la la-angle-down"></i></a>
                  <ul class="dropdown-menu-item">
                    <li><a href="{{ route('website.rooms') }}">Ruangan</a></li>
                    <li><a href="{{ route('website.cars') }}">Kendaraan</a></li>
                    <li><a href="{{ route('website.report') }}">Laporan</a></li>
                  </ul>
                </li>
                <li>
                  <a href="{{ route('website.status') }}">Status</a>
                </li>
                <li>
                  <a href="https://asrama.itb.ac.id" target="_blank">Asrama</a>
                </li>
              </ul>
            </nav>
          </div>
          <!-- end main-menu-content -->
          <div class="nav-btn">
            <a href="#" class="theme-btn theme-btn-small" data-toggle="modal" data-target="#loginPopupForm">Masuk</a>
          </div>
          <!-- end nav-btn -->
        </div>
        <!-- end menu-wrapper -->
      </div>
      <!-- end col-lg-12 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end container-fluid -->
</div>
<!-- end header-menu-wrapper -->