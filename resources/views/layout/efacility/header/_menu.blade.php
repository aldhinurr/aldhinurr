<div class="header-menu-wrapper padding-right-100px padding-left-100px">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="menu-wrapper">
          <a href="#" class="down-button">
            <i class="la la-angle-down"></i>
          </a>
          <div class="logo pt-2 pb-2">
            <a href="{{ route('website.index') }}">
              <img src="{{ asset('efacility/images/logo-efacility-putih.png') }}" alt="logo" style="width: 20rem;" />
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
                  <a href="#">Layanan <i class="la la-angle-down"></i>
                  </a>
                  <ul class="dropdown-menu-item">
                    <li>
                      <a href="https://asrama.itb.ac.id" target="_blank">Asrama</a>
                    </li>
                    <li>
                      <a href="{{ route('website.barang') }}">Informasi Barang Tidak Digunakan</a>
                    </li>
                    <li>
                      <a href="{{ route('resource.page') }}"><i>Resource Sharing</i></a>
                    </li>
                    <li>
                      <a href="{{ route('sewa.page') }}">Sewa Layanan</a>
                    </li>
                    <li>
                      <a href="{{ route('website.lab') }}">Uji Laboratorium</a>
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="{{ route('website.status') }}">Cek Pesanan</a>
                </li>
                    <li>
                      <a href="#">Dokumen <i class="la la-angle-down"></i>
                      </a>
                      <ul class="dropdown-menu-item">
                        <li>
                          <a href="https://e-facility.itb.ac.id/media/documents/User%20-%20Panduan%20Penggunaan%20Layanan%20E-Facility%20Versi%2008-Mar-2024.pdf" target="_blank">Panduan</a>
                        </li>
                        <!-- <li>
                            <a href="/media/documents/SK%20Tarif.pdf" target="_blank">SK Tarif</a>
                        </li> -->
                        <!-- <li>
                          <a href="#">SOP Layanan & Penyewaan</a>
                        </li> -->
                      </ul>
                    </li>
                <li>
                  <a href="{{ route('website.about') }}">Tentang</a>
                </li>
                <!-- end main-menu-content -->
                @if (!Auth::check())
                <a href="{{ route('login-page') }}" class="btn btn-primary">Masuk</a>
                <!-- end nav-btn -->
                @endif
                <!-- <li><a href="https://asrama.itb.ac.id" target="_blank">Asrama</a></li> -->
                @if (Auth::check())
                <li>
                  <a href="#">{{ auth()->user()->name }}
                    <i class="la la-angle-down"></i>
                  </a>
                  <ul class="dropdown-menu-item">
                    @if (auth()->user()->hasRole(['admin', 'superadmin', 'fasilitas', 'laporan', 'pemeliharaanSP', 'pemeliharaanUNIT', 'layanan', 'fasilitas1', 'user_role', 'sewa', 'gedung', 'lantai', 'perbaikan']))
                    <li>
                      <a href="{{ route('admin.index') }}" target="_blank">Halaman
                        Pengelola</a>
                    </li>
                    @else
                    <!-- <li>
                      <a href="/media/documents/User%20-%20Panduan%20Penggunaan%20Layanan%20E-Facility%20Versi%2008-Mar-2024.pdf" 
                        download="User - Panduan Penggunaan Layanan E-Facility Versi 08-Mar-2024.pdf">Panduan Penggunaan
                      </a>
                    </li> -->
                    @endif
                    <li>
                      <!-- <a href="#" data-action="{{ theme()->getPageUrl('logout') }}" data-method="post" data-csrf="{{ csrf_token() }}" data-reload="true" class="logout-button"> -->
                      <a href="https://e-facility.itb.ac.id/logout/azure">
                           {{ __('Keluar') }}
                           </a> 
                    </li>
                  </ul>
                </li>
                <!-- Button untuk menampilkan modal -->
                <button id="showNotificationBtn" class="notification-btn">
                  <i class="la la-bell"></i>
                  @if ($activityCount > 0)
                  <span class="badge_notif">{{ $activityCount }}</span>
                  @endif
                </button>
                <!-- Modal Notifikasi -->
                <div id="notificationModal" class="notification-modal">
                  <div class="modal-content">
                    <span class="close-btn" id="closeNotificationBtn">&times;</span>
                    <div class="modal-body">
                      @csrf
                      <!-- Untuk melindungi form dari serangan CSRF -->
                      @if (count($activity) === 0)
                      <p>Tidak ada notifikasi.</p>
                      @else
                      @foreach ($activity as $entry)
                      @if (!$entry->read_content)
                      @if (!request()->is('reservation/*'))
                      <form action="{{ route('markAsRead', $entry->reservation_id) }}" method="POST">
                        @csrf
                        <ul class="status-list">
                          <li class="status-entry">
                            <button type="submit" class="btn btn-link" style="text-align: left;">
                              <p style="font-size: 13px; line-height: 1.5; color: #333;">
                                Status sewa
                                <b>{{ $entry->layanan_name }}</b>
                                adalah <b>{{ $entry->status }}</b>,
                                sewa dimulai tanggal
                                {{ \Carbon\Carbon::parse($entry->start_date)->format('d-m-Y H:i') }}
                                s/d
                                {{ \Carbon\Carbon::parse($entry->end_date)->format('d-m-Y H:i') }}
                              </p>
                              <small class="updated-time" style="font-size: 11px; color: #333;">{{ \Carbon\Carbon::parse($entry->updated_at)->setTimezone('Asia/Jakarta')->format('j M, \a\t g:i a') }}</small>
                            </button>
                            <div style="border-bottom: 1px solid #c2c2d6;">
                            </div>
                          </li>
                        </ul>
                      </form>
                      @endif
                      @endif
                      @endforeach
                      @endif
                    </div>
                  </div>
                </div>
                <script>
                  document.addEventListener('DOMContentLoaded', function() {
                    var showNotificationBtn = document.getElementById('showNotificationBtn');
                    var notificationModal = document.getElementById('notificationModal');
                    var closeNotificationBtn = document.getElementById('closeNotificationBtn');

                    showNotificationBtn.addEventListener('click', function() {
                      // Toggle the display style of the modal between 'block' and 'none'
                      notificationModal.style.display = (notificationModal.style.display === 'block') ? 'none' :
                        'block';
                    });

                    closeNotificationBtn.addEventListener('click', function() {
                      // Close the modal when the close button is clicked
                      notificationModal.style.display = 'none';
                    });

                    window.addEventListener('click', function(event) {
                      // Close the modal if the user clicks outside of it
                      if (event.target === notificationModal) {
                        notificationModal.style.display = 'none';
                      }
                    });
                  });
                </script>
                @endif
              </ul>
          </div>
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