<div class="header-menu-wrapper padding-right-100px padding-left-100px">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="menu-wrapper">
          <a href="#" class="down-button"><i class="la la-angle-down"></i></a>
          <div class="logo pt-2 pb-2">
            <a href="{{ route('website.index') }}">
              <img src="{{ asset('efacility/images/logo-efacility-putih.png') }}" alt="logo"
                style="width: 20rem;" />
            </a>
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
                    <li><a href="{{ route('website.repair') }}">Perbaikan</a></li>
                  </ul>
                </li>
                <li>
                  <a href="{{ route('website.status') }}">Status</a>
                </li>
                <li>
                  <a href="https://asrama.itb.ac.id" target="_blank">Asrama</a>
                </li>
                @if (Auth::check())
                  <li>
                    <a href="#">{{ auth()->user()->name }} <i class="la la-angle-down"></i></a>
                    <ul class="dropdown-menu-item">
                      @if (auth()->user()->hasRole(['admin', 'superadmin']))
                        <li><a href="{{ route('admin.index') }}" target="_blank">Halaman Admin</a></li>
                      @endif
                      <li>
                        <a href="#" data-action="{{ theme()->getPageUrl('logout') }}" data-method="post"
                          data-csrf="{{ csrf_token() }}" data-reload="true" class="logout-button">
                          {{ __('Keluar') }}
                        </a>
                      </li>
                    </ul>
                  </li>
                @endif
              </ul>
          </div>
          <!-- end main-menu-content -->
          @if (!Auth::check())
            <div class="nav-btn">
              <a href="{{ route('login') }}" class="theme-btn theme-btn-small">Masuk</a>
            </div>
            <!-- end nav-btn -->
          @endif
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
