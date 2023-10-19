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
                    <!-- <li><a href="{{ route('website.report') }}" hidden>Laporan</a></li> -->
                    <li><a href="{{ route('website.selasar') }}">Selasar</a></li>
                    <li><a href="{{ route('website.lapangan') }}">Lapangan</a></li>
                    <li><a href="{{ route('website.repair') }}">Pemeliharaan / Perawatan</a></li>
                    <li><a href="https://sipa.nrcn.itb.ac.id/listtools" target="_blank">Uji Laboratorium</a></li>
                  </ul>
                </li>
                <li>
                  <a href="{{ route('website.status') }}">Status</a>
                </li>
                <li>
                  <a href="http://ditsp.itb.ac.id/wp-content/uploads/sites/13/2023/10/Panduan-Penggunaan-Layanan-E-Facility-Versi-1.pdf"
                    target="_blank">Panduan</a>
                </li>
                <!-- <li><a href="https://asrama.itb.ac.id" target="_blank">Asrama</a></li> -->
                @if (Auth::check())
                  <li>
                    <a href="#">{{ auth()->user()->name }} <i class="la la-angle-down"></i></a>
                    <ul class="dropdown-menu-item">
                      @if (auth()->user()->hasRole(['admin', 'superadmin']))
                        <li><a href="{{ route('admin.index') }}" target="_blank">Halaman Pengelola</a></li>
                      @endif
                      <li>
                        <!-- <a href="#" data-action="{{ theme()->getPageUrl('logout') }}" data-method="post" data-csrf="{{ csrf_token() }}" data-reload="true" class="logout-button">
                        {{ __('Keluar') }}
                      </a> -->
                        <a href="https://e-facility.itb.ac.id/logout/azure">
                          Keluar
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
              <a href="{{ route('login-page') }}" class="theme-btn theme-btn-small">Masuk</a>
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
