<div class="sidebar single-content-sidebar mb-0 mr-2">
  <div class="sidebar-widget single-content-widget">
    <div class="row justify-content-between m-0">
      <h3 class="title stroke-shape">Pinjam</h3> 
  </div>
    <div class="2024-box">
    </div>
    <div class="sidebar-widget-item">
      <div class="contact-form-action">
        <form action="#" id="sewa">
          @csrf
          <div class="input-box">
            <label class="label-text">Unit</label>
            <div class="form-group">
              <select id="unit" name="unit" class="form-control w-100">
                <!-- Check if the user is authenticated -->
                @if(Auth::check())
                <!-- Set default value based on Auth::user()->itb_unit -->
                  <option value="{{ Auth::user()->itb_unit ?: '' }}">{{ Auth::user()->itb_unit ?: '' }}</option>
                @else
                <!-- Default option for not logged in users -->
                  <option value=""></option>
                @endif
                <option value="Badan Pengelola Usaha dan Dana Lestari">Badan Pengelola Usaha dan Dana Lestari</option>
                <option value="Biro Administrasi Umum dan Informasi">Biro Administrasi Umum dan Informasi</option>
                <option value="Biro Kemitraan">Biro Kemitraan</option>
                <option value="Biro Komunikasi dan Hubungan Masyarakat">Biro Komunikasi dan Hubungan Masyarakat</option>
                <option value="Direktorat Administrasi Umum">Direktorat Administrasi Umum</option>
                <option value="Direktorat Eksekutif Pengelolaan Penerimaan Mahasiswa dan Kerjasama Pendidikan">Direktorat Eksekutif Pengelolaan Penerimaan Mahasiswa dan Kerjasama Pendidikan</option>
                <option value="Direktorat Hubungan Masyarakat dan Alumni">Direktorat Hubungan Masyarakat dan Alumni</option>
                <option value="Direktorat ITB Kampus Cirebon">Direktorat ITB Kampus Cirebon</option>
                <option value="Direktorat ITB Kampus Jakarta">Direktorat ITB Kampus Jakarta</option>
                <option value="Direktorat ITB Kampus Jatinangor">Direktorat ITB Kampus Jatinangor</option>
                <option value="Direktorat Kawasan Sains dan Teknologi">Direktorat Kawasan Sains dan Teknologi</option>
                <option value="Direktorat Kemahasiswaan">Direktorat Kemahasiswaan</option>
                <option value="Direktorat Kemitraan & Hubungan Internasional">Direktorat Kemitraan & Hubungan Internasional</option>
                <option value="Direktorat Kepegawaian">Direktorat Kepegawaian</option>
                <option value="Direktorat Keuangan">Direktorat Keuangan</option>
                <option value="Direktorat Logistik">Direktorat Logistik</option>
                <option value="Direktorat Pendidikan Non Reguler">Direktorat Pendidikan Non Reguler</option>
                <option value="Direktorat Pendidikan">Direktorat Pendidikan</option>
                <option value="Direktorat Penerapan Ilmu dan Teknologi Multidisiplin">Direktorat Penerapan Ilmu dan Teknologi Multidisiplin</option>
                <option value="Direktorat Pengembangan Pendidikan">Direktorat Pengembangan Pendidikan</option>
                <option value="Direktorat Pengembangan">Direktorat Pengembangan</option>
                <option value="Direktorat Perencanaan Sumberdaya">Direktorat Perencanaan Sumberdaya</option>
                <option value="Direktorat Perencanaan">Direktorat Perencanaan</option>
                <option value="Direktorat Sarana dan Prasarana">Direktorat Sarana dan Prasarana</option>
                <option value="Direktorat Teknologi Informasi">Direktorat Teknologi Informasi</option>
                <option value="Fakultas Ilmu dan Teknologi Kebumian">Fakultas Ilmu dan Teknologi Kebumian</option>
                <option value="Fakultas Matematika dan Ilmu Pengetahuan Alam">Fakultas Matematika dan Ilmu Pengetahuan Alam</option>
                <option value="Fakultas Seni Rupa dan Desain">Fakultas Seni Rupa dan Desain</option>
                <option value="Fakultas Teknik Mesin dan Dirgantara">Fakultas Teknik Mesin dan Dirgantara</option>
                <option value="Fakultas Teknik Pertambangan dan Perminyakan">Fakultas Teknik Pertambangan dan Perminyakan</option>
                <option value="Fakultas Teknik Sipil dan Lingkungan">Fakultas Teknik Sipil dan Lingkungan</option>
                <option value="Fakultas Teknologi Industri">Fakultas Teknologi Industri</option>
                <option value="HaKI">HaKI</option>
                <option value="Institut Teknologi Bandung">Institut Teknologi Bandung</option>
                <option value="Kampus ITB">Kampus ITB</option>
                <option value="Kantor Hukum">Kantor Hukum</option>
                <option value="Kantor Kealumnian">Kantor Kealumnian</option>
                <option value="Kantor Majelis Guru Besar">Kantor Majelis Guru Besar</option>
                <option value="Kantor Satuan Kekayaan dan Dana">Kantor Satuan Kekayaan dan Dana</option>
                <option value="Kantor WRAM">Kantor WRAM</option>
                <option value="Kantor WRII">Kantor WRII</option>
                <option value="Kantor WRSD">Kantor WRSD</option>
                <option value="Kantor WRUK">Kantor WRUK</option>
                <option value="Laboratorium Produksi Litbang Integrasi & Aplikasi ITB">Laboratorium Produksi Litbang Integrasi & Aplikasi ITB</option>
                <option value="Lembaga Bimbingan Konseling">Lembaga Bimbingan Konseling</option>
                <option value="Lembaga Kemahasiswaan">Lembaga Kemahasiswaan</option>
                <option value="Lembaga Layanan Hukum">Lembaga Layanan Hukum</option>
                <option value="Direktorat Riset dan Pengabdian Kepada Masyarakat">Direktorat Riset dan Pengabdian Kepada Masyarakat</option>
                <option value="Majelis Wali Amanat">Majelis Wali Amanat</option>
                <option value="Program Tahap Persiapan Bersama">Program Tahap Persiapan Bersama</option>
                <option value="Pusat Ilmu Hayati">Pusat Ilmu Hayati</option>
                <option value="Pusat Infrastruktur Data Spasial">Pusat Infrastruktur Data Spasial</option>
                <option value="Pusat Kebijakan Keenergian">Pusat Kebijakan Keenergian</option>
                <option value="Pusat Kebijakan Publik dan Kepemerintahan">Pusat Kebijakan Publik dan Kepemerintahan</option>
                <option value="Pusat Lingkungan Hidup">Pusat Lingkungan Hidup</option>
                <option value="Pusat Mikroelektronika">Pusat Mikroelektronika</option>
                <option value="Pusat Mitigasi Bencana">Pusat Mitigasi Bencana</option>
                <option value="Pusat Pangan, Kesehatan dan Obat-obatan">Pusat Pangan, Kesehatan dan Obat-obatan</option>
                <option value="Pusat Pemberdayaan Perdesaan">Pusat Pemberdayaan Perdesaan</option>
                <option value="Pusat Pemodelan Matematika dan Simulasi">Pusat Pemodelan Matematika dan Simulasi</option>
                <option value="Pusat Pendayagunaan Open Source Software">Pusat Pendayagunaan Open Source Software</option>
                <option value="Pusat Penelitian Bioteknologi">Pusat Penelitian Bioteknologi</option>
                <option value="Pusat Penelitian dan Pengembangan">Pusat Penelitian dan Pengembangan</option>
                <option value="Pusat Penelitian Nanosains dan Nanoteknologi">Pusat Penelitian Nanosains dan Nanoteknologi</option>
                <option value="Pusat Penelitian Pengembangan Wilayah dan Infrastruktur">Pusat Penelitian Pengembangan Wilayah dan Infrastruktur</option>
                <option value="Pusat Penelitian Produk Budaya dan Lingkungan">Pusat Penelitian Produk Budaya dan Lingkungan</option>
                <option value="Pusat Penelitian Teknologi Informasi dan Komunikasi">Pusat Penelitian Teknologi Informasi dan Komunikasi</option>
                <option value="Pusat Pengembangan Kawasan Pesisir dan Laut">Pusat Pengembangan Kawasan Pesisir dan Laut</option>
                <option value="Pusat Pengembangan Sumberdaya Air">Pusat Pengembangan Sumberdaya Air</option>
                <option value="Pusat Penginderaan Jauh">Pusat Penginderaan Jauh</option>
                <option value="Pusat pengkajian Logistik dan Sistem Rantai Pasok">Pusat pengkajian Logistik dan Sistem Rantai Pasok</option>
                <option value="Pusat Perencanaan dan Pengembangan Kepariwisataan">Pusat Perencanaan dan Pengembangan Kepariwisataan</option>
                <option value="Pusat Perubahan Iklim">Pusat Perubahan Iklim</option>
                <option value="Pusat Rekayasa Industri">Pusat Rekayasa Industri</option>
                <option value="Pusat Studi Sarana dan Prasarana Tahan Gempa">Pusat Studi Sarana dan Prasarana Tahan Gempa</option>
                <option value="Pusat Studi Sistem Tak Berawak">Pusat Studi Sistem Tak Berawak</option>
                <option value="Pusat Teknologi Instrumentasi dan Otomasi">Pusat Teknologi Instrumentasi dan Otomasi</option>
                <option value="Pusat Teknologi Kesehatan & Keolahragaan">Pusat Teknologi Kesehatan & Keolahragaan</option>
                <option value="Satuan Pengawas Internal">Satuan Pengawas Internal</option>
                <option value="Satuan Penjaminan Mutu">Satuan Penjaminan Mutu</option>
                <option value="Satuan Usaha Komersial">Satuan Usaha Komersial</option>
                <option value="Sekolah Arsitektur, Perencanaan dan Pengembangan Kebijakan">Sekolah Arsitektur, Perencanaan dan Pengembangan Kebijakan</option>
                <option value="Sekolah Bisnis dan Manajemen">Sekolah Bisnis dan Manajemen</option>
                <option value="Sekolah Farmasi">Sekolah Farmasi</option>
                <option value="Sekolah Ilmu dan Teknologi Hayati">Sekolah Ilmu dan Teknologi Hayati</option>
                <option value="Sekolah Pasca Sarjana">Sekolah Pasca Sarjana</option>
                <option value="Sekolah Teknik Elektro dan Informatika">Sekolah Teknik Elektro dan Informatika</option>
                <option value="Sekretariat Institut">Sekretariat Institut</option>
                <option value="Unit Keamanan, Kesehatan dan Keselamatan Kerja dan Lingkungan">Unit Keamanan, Kesehatan dan Keselamatan Kerja dan Lingkungan</option>
                <option value="Unit Pelaksana Teknis Asrama">Unit Pelaksana Teknis Asrama</option>
                <option value="UPT Olahraga">UPT Olahraga</option>
                <option value="UPT Pelayanan Kesehatan">UPT Pelayanan Kesehatan</option>
                <option value="UPT Pengadaan">UPT Pengadaan</option>
                <option value="UPT Pengembangan Manusia dan Organisasi">UPT Pengembangan Manusia dan Organisasi</option>
                <option value="UPT Pengembangan SDM">UPT Pengembangan SDM</option>
                <option value="UPT Perpustakaan">UPT Perpustakaan</option>
                <option value="UPT Pusat Bahasa">UPT Pusat Bahasa</option>
                <option value="UPT Saraga dan Sabuga">UPT Saraga dan Sabuga</option>
              </select>
            </div>
          </div>
          <div class="input-box">
            <label class="label-text">Mulai</label>
            <div class="form-group">
              <span class="la la-calendar form-icon"></span>
              <input class="date-range form-control" type="text" name="daterange-single" id="start_date">
            </div>
          </div>
          <div class="input-box">
            <label class="label-text">Selesai</label>
            <div class="form-group">
              <span class="la la-calendar form-icon"></span>
              <input class="date-range form-control" type="text" name="daterange-single" id="end_date">
            </div>
          </div>
          <h4 id="is_available" class="pb-2">
            <span class="badge badge-success">Tersedia</span>
          </h4>
          <div class="total-price">
            <label class="d-flex justify-content-between align-items-center">Duration
              <span class="text-black font-weight-regular"><input type="text" id="duration" name="duration"
                  class="text-right" value="{{ old('duration') ?? '1' }}" readonly="readonly" />
                {{ $data->price_for }}</span>
            </label>
          </div>
          @if (old('fee') ?? $data->price != 0)
          <div class="total-price">
            <label class="d-flex justify-content-between align-items-center">Biaya
              <span class="text-black font-weight-regular">Rp. <input type="text" id="fee"
                  class="num text-right" name="fee" value="{{ old('fee') ?? $data->price }}"
                  readonly="readonly" /></span></label>
          </div>          
          @else
          <div class="total-price {{ (old('fee') ?? $data->price) == 0 ? 'd-none' : '' }}">
              <label class="d-flex justify-content-between align-items-center">Biaya
                  <span class="text-black font-weight-regular">Rp. 
                      <input type="text" id="fee" class="num text-right" name="fee" value="{{ old('fee') ?? $data->price }}" readonly="readonly" />
                  </span>
              </label>
          </div>
          @endif
          <hr>
          <div class="input-box">
            <label class="label-text">Catatan/Nama Kegiatan</label>
            <div class="form-group">
              <span class="la la-pencil form-icon"></span>
              <textarea class="message-control form-control" id="catatan" name="catatan"></textarea>
            </div>
          </div>
          <div class="input-box">
            <label class="label-text">Tambah Fasilitas</label>
            <div class="form-group">
              <select id="fasilitas" name="fasilitas" class="form-control w-100"></select>
              <div class="d-flex justify-content-end">
                <a href="#" id="add-fasilitas"
                  class="btn btn-small btn-primary text-center mt-2 col-lg-4">Tambah</a>
              </div>
            </div>
          </div>
          <h3 class="title stroke-shape" hidden>Fasilitas Tambahan</h3>
          <div id="extraServiceList" class="pt-3">
            <label for="info-extra-service" id="info-extra-service">Tidak ada fasilitas tambahan.</label>
            {{-- <div class="custom-checkbox">
              <input type="checkbox" name="cleaning" id="cleaningChb" value="15.00" />
              <label for="cleaningChb" class="d-flex justify-content-between align-items-center">Cleaning
                Fee <span class="text-black font-weight-regular">$15</span></label>
            </div> --}}
          </div>
          @if (old('fee') ?? $data->price != 0)
          <div class="total-price pt-3 d-flex justify-content-between">
            <label class="label-text">Total</label>
            <p class="d-flex align-items-center"><span class="font-size-17 text-black">Rp. <input type="text"
                  id="total" name="total" class="num text-right" value="{{ $data->price }}"
                  readonly="readonly" />
              </span>
            </p>
          </div>        
          @else
          <div class="total-price {{ (old('fee') ?? $data->price) == 0 ? 'd-none' : '' }}">
            <label class="label-text">Total</label>
            <p class="d-flex align-items-center"><span class="font-size-17 text-black">Rp. <input type="text"
                  id="total" name="total" class="num text-right" value="{{ $data->price }}"
                  readonly="readonly" />
              </span>
            </p>
          </div> 
          @endif
        </form>
      </div>
    </div><!-- end sidebar-widget-item -->
  </div><!-- end sidebar-widget -->
  <div class="btn-box">
    <a href="#" id="submit-sewa" class="theme-btn text-center w-100 mb-2">Pinjam</a>
  </div>
  <div class="input-box">
      <div class="alert alert-danger label-text" id="alert" role="alert" style="display: none">
          A simple danger alert—check it out!
      </div>
  </div>
  <div class="footer-item text-center padding-top-20px">
  <ul class="list-items list--items">
      @if ($data->type == 'RUANG')
        <li><a href="{{ route('website.rooms') }}">Lihat Ruangan Lainnya</a></li>
      @elseif ($data->type == 'KENDARAAN')
        <li><a href="{{ route('website.cars') }}">Lihat Kendaraan Lainnya</a></li>
      @elseif ($data->type == 'RKU')
        <li><a href="{{ route('website.rku') }}">Lihat Ruang Kuliah Umum Lainnya</a></li>
      @elseif ($data->type == 'RUMAH SUSUN')
        <li><a href="{{ route('website.rumah') }}">Lihat Rumah Susun / Transit Lainnya</a></li>
      @elseif ($data->type == 'SELASAR')
        <li><a href="{{ route('website.selasar') }}">Lihat Selasar Lainnya</a></li>
      @elseif ($data->type == 'LAPANGAN')
        <li><a href="{{ route('website.lapangan') }}">Lihat Lapangan Lainnya</a></li>
      @endif
      <li><a href="{{ route('website.status') }}#my-sewa">Lihat Status Peminjaman</a></li>
    </ul>
  </div>
</div><!-- end sidebar -->

<!-- Include jQuery (required for Select2) -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function () {
    $('#unit').select2({
      placeholder: 'Pilih Unit',
      allowClear: true // Optional: Add a clear button
    });
  });
</script>
