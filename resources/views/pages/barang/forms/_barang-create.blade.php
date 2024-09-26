<!--begin::Basic info-->
<div class="card {{ $class }}">
  <!--begin::Card header-->
  <div class="card-header rotate cursor-pointer border-0" role="button" data-bs-toggle="collapse"
    data-bs-target="#kt_barang_create" aria-expanded="true" aria-controls="kt_barang_create">
    <!--begin::Card title-->
    <div class="card-title m-0">
      <h3 class="fw-bolder m-0">{{ __('Tambah Data Informasi Barang Tidak Digunakan') }}</h3>
    </div>
    <!--end::Card title-->
  </div>
  <!--begin::Card header-->

  <!--begin::Content-->
  <div id="kt_barang_create" class="show collapse">
    <!--begin::Form-->
    <form id="kt_barang_create_form" class="form" method="POST" action="{{ route('barang.store') }}">
      @csrf
      <!--begin::Card body-->
      <div class="card-body border-top p-9">
                <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">
            <span>{{ __('Unit Pengelola') }}</span>
          </label>
          <!--end::Label-->

          <!--begin::Col-->
          <style>
           /* Mengubah warna teks menjadi hitam */
           .select2-container .select2-selection--single .select2-selection__rendered {
            color: black !important;
           }
          </style>
          <div class="col-lg-7 fv-row">
           <div class="form-group">
            <select id="unit_itb" name="unit_itb" class="form-control w-100">
             <!-- Check if the user is authenticated -->
             <option value="" disabled selected>Pilih Unit</option>
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
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet" />
          <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
          <script>
           $(document).ready(function() {
            $('#unit_itb').select2();
           });
          </script>
          <!--end::Col-->
        </div>
        <!--end::Input group-->
        
        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Nomor Aset') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-2 fv-row">
            <input type="number" name="nomor_aset" class="form-control"/>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

                <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Nama Barang') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-4 fv-row">
            <input type="text" name="nama_barang" class="form-control"/>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

                <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Merk/Type') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-4 fv-row">
            <input type="text" name="merk" class="form-control"/>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

                <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Jumlah') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-2 fv-row">
            <input type="number" name="jumlah" class="form-control"/>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Lokasi Penyimpanan') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-4 fv-row">
            <input type="text" name="lokasi" class="form-control"
            value="{{ old('name', $barang->lokasi ?? '') }}" />
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Kondisi Barang') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-4 fv-row">
            <textarea name="kondisi" class="form-control" placeholder="Jelaskan kondisi barang..."></textarea>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Upload Foto') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-3 fv-row">
            <input type="file" name="foto" accept=".jpg, .png" class="form-control"/>
          </div>
          <!--end::Col-->
        </div>

      </div>
      <!--end::Card body-->

      <!--begin::Actions-->
      <div class="card-footer d-flex justify-content-end px-9 py-6">
        <a href="{{ route('barang.index') }}" type="reset"
          class="btn btn-white btn-active-light-primary me-2">{{ __('Kembali') }}</a>
        <button type="button" class="btn btn-primary" id="kt_barang_create_submit">
          @include('partials.general._button-indicator', ['label' => __('Simpan')])
        </button>
      </div>
      <!--end::Actions-->
    </form>
    <!--end::Form-->
  </div>
  <!--end::Content-->
</div>
<!--end::Basic info-->
