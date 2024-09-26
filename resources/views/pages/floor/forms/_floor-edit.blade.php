<!--begin::Basic info-->
<div class="card {{ $class }}">
  <!--begin::Card header-->
  <div class="card-header rotate cursor-pointer border-0" role="button" data-bs-toggle="collapse"
    data-bs-target="#kt_floor_create" aria-expanded="true" aria-controls="kt_floor_create">
    <!--begin::Card title-->
    <div class="card-title m-0">
      <h3 class="fw-bolder m-0">{{ __('Edit Lantai & Ruangan ') }}</h3>
      <!--begin::Separator-->
      <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
      <!--end::Separator-->

      <!--begin::Description-->
      <!-- <small class="text-muted fs-7 fw-bold my-1 ms-1">
        {{ __('Ubah Data Lantai & Ruang') }}
      </small> -->
      <!--end::Description-->
    </div>
    <!--end::Card title-->
  </div>
  <!--begin::Card header-->

  <!--begin::Content-->
  <div id="kt_floor_create" class="show collapse">
    <!--begin::Form-->
    <form id="kt_floor_create_form" class="form" method="POST" action="{{ route('floor.update', $floor->id) }}">
      @csrf
      @method('PUT')
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
          <div class="col-lg-8 fv-row">
            <input type="text" value="{{ old('number', $floor->unit_itb ?? '') }}" disabled="disabled" class="form-control form-control-lg form-control-solid" />
            <input type="hidden" name="unit_itb" id="unit_itb" value="{{ old('number', $floor->unit_itb ?? '') }}">
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <style>
          /* CSS untuk mengubah warna teks menjadi hitam */
          .select2-selection__rendered {
            color: black !important;
          }
        </style>
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Kategori') }}</label>
          <!--end::Label-->
          <div class="col-lg-6 fv-row">
            <select id="kategori_ruangan" name="kategori_ruangan" class="form-control w-100">
              <option value="{{ old('kategori_ruangan', $floor->kategori_ruangan ?? '') }}" selected>{{ old('kategori_ruangan', $floor->kategori_ruangan ?? '') }}</option>
              <option disabled><br></option>
              <option value="Area Parkir">Area Parkir</option>
              <option value="Asrama Mahasiswa">Asrama Mahasiswa</option>
              <option value="Coworking Space">Coworking Space</option>
              <option value="Fasilitas Olahraga Ruang Tertutup">Fasilitas Olahraga Ruang Tertutup</option>
              <option value="Fasilitas Olahraga Terbuka">Fasilitas Olahraga Terbuka</option>
              <option value="Hotel">Hotel</option>
              <option value="Jalan">Jalan</option>
              <option value="Janitor">Janitor</option>
              <option value="Koridor/Teras">Koridor/Teras</option>
              <option value="Lapangan">Lapangan</option>
              <option value="Pantri">Pantri</option>
              <option value="Ruang Administrasi">Ruang Administrasi</option>
              <option value="Ruang Asisten Dosen">Ruang Asisten Dosen</option>
              <option value="Ruangan Auditor">Ruangan Auditor</option>
              <option value="Ruang Aula/Galeri">Ruang Aula/Galeri</option>
              <option value="Ruang Bengkel/Workshop/Studio">Ruang Bengkel/Workshop/Studio</option>
              <option value="Ruang Dapur">Ruang Dapur</option>
              <option value="Ruang Diskusi/Area Belajar Mahasiswa">Ruang Diskusi/Area Belajar Mahasiswa</option>
              <option value="Ruang Dosen">Ruang Dosen</option>
              <option value="Ruang Fasilitas Komputasi">Ruang Fasilitas Komputasi</option>
              <option value="Ruang Fotocopy">Ruang Fotocopy</option>
              <option value="Ruang Gudang">Ruang Gudang</option>
              <option value="Ruang Kantin">Ruang Kantin</option>
              <option value="Ruang Kantor Sewa">Ruang Kantor Sewa</option>
              <option value="Ruang Kelas Besar">Ruang Kelas Besar</option>
              <option value="Ruang Kelas Kecil">Ruang Kelas Kecil</option>
              <option value="Ruang Kelas Sedang">Ruang Kelas Sedang</option>
              <option value="Ruang Kemahasiswaan Prodi">Ruang Kemahasiswaan Prodi</option>
              <option value="Ruang Kendali CCTV">Ruang Kendali CCTV</option>
              <option value="Ruang Kuliah">Ruang Kuliah</option>
              <option value="Ruang Laboratorium">Ruang Laboratorium</option>
              <option value="Ruang Lift">Ruang Lift</option>
              <option value="Ruang Limbah">Ruang Limbah</option>
              <option value="Ruang Mahasiswa TA/Tesis/Desertasi">Ruang Mahasiswa TA/Tesis/Desertasi</option>
              <option value="Ruang Multimedia">Ruang Multimedia</option>
              <option value="Ruang Mushola">Ruang Mushola</option>
              <option value="Ruang Pamer">Ruang Pamer</option>
              <option value="Ruang Panel">Ruang Panel</option>
              <option value="Ruang Perbankan">Ruang Perbankan</option>
              <option value="Ruang Perpustakaan/Baca">Ruang Perpustakaan/Baca</option>
              <option value="Ruang Pimpinan">Ruang Pimpinan</option>
              <option value="Ruang Pimpinan Fakultas">Ruang Pimpinan Fakultas</option>
              <option value="Ruang Pimpinan ITB/SA/MWA">Ruang Pimpinan ITB/SA/MWA</option>
              <option value="Ruang Pimpinan KK">Ruang Pimpinan KK</option>
              <option value="Ruang Pimpinan Prodi">Ruang Pimpinan Prodi</option>
              <option value="Ruang Pimpinan UKP">Ruang Pimpinan UKP</option>
              <option value="Ruang Pos Keamanan">Ruang Pos Keamanan</option>
              <option value="Ruang Praktikum">Ruang Praktikum</option>
              <option value="Ruang Rapat Besar">Ruang Rapat Besar</option>
              <option value="Ruang Rapat Kecil">Ruang Rapat Kecil</option>
              <option value="Ruang Sekretariat">Ruang Sekretariat</option>
              <option value="Ruang Seminar">Ruang Seminar</option>
              <option value="Ruang Serbaguna">Ruang Serbaguna</option>
              <option value="Ruang Server">Ruang Server</option>
              <option value="Ruang Tamu/Lobby/Lounge">Ruang Tamu/Lobby/Lounge</option>
              <option value="Ruang Toilet">Ruang Toilet</option>
              <option value="Ruang Tunggu">Ruang Tunggu</option>
              <option value="Ruang UKM/Himpunan/Bersama Kemahasiswaan">Ruang UKM/Himpunan/Bersama Kemahasiswaan</option>
              <option value="Ruang Utilitas Air">Ruang Utilitas Air</option>
              <option value="Ruang Utilitas Listrik">Ruang Utilitas Listrik</option>
              <option value="Ruang Utilitas Telepon">Ruang Utilitas Telepon</option>
              <option value="Rumah Dinas/Wisma">Rumah Dinas/Wisma</option>
              <option value="Rumah Singgah Dosen/Transit">Rumah Singgah Dosen/Transit</option>
              <option value="Sarana Olahraga">Sarana Olahraga</option>
              <option value="Selasar Umum">Selasar Umum</option>
              <option value="Taman">Taman</option>
              <option value="Tangga">Tangga</option>
              <option value="Toko">Toko</option>
            </select><br><br>
            <a href="/media/documents/Keterangan Kategori.pdf" target="_blank">
                <i class="fa fa-info-circle"></i> Keterangan Kategori Data Lantai & Ruang
            </a>
          </div>
        </div>

        {{--
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Kategori') }}</label>
          <!--end::Label-->
          <div class="col-lg-6 fv-row">
            <select name="room_classification" class="form-control form-control-lg">
              <option value="{{ $floor->room_classification }}">{{ $floor->room_classification }}</option>
              <option value="">~ Pilih Kategori ~</option>
              <option value="AULA">Aula</option>
              <option value="KAMAR MANDI">Kamar Mandi</option>
              <option value="LABORATORIUM">Laboratorium</option>
              <option value="LAPANGAN">Lapangan</option>
              <option value="MUSHOLA">Mushola</option>
              <option value="RUANG DOSEN">Ruang Dosen</option>
              <option value="RUANG KERJA">Ruang Kerja</option>
              <option value="RUANG KULIAH">Ruang Kuliah</option>
              <option value="RUANG PIMPINAN">Ruang Pimpinan</option>
              <option value="RUANG PRATIKUM">Ruang Pratikum</option>
              <option value="RUANG RAPAT">Ruang Rapat</option>
              <option value="RUANG SEMINAR">Ruang Seminar</option>
              <option value="RUANG SERBA GUNA">Ruang Serba Guna</option>
              <option value="RUANG SERVER">Ruang Server</option>
              <option value="RUANG TAMU">Ruang Tamu</option>
              <option value="RUANG TUNGGU">Ruang Tunggu</option>
              <option value="RUANG UKM">Ruang UKM</option>
              <option value="SARANA OLAHRAGA">Sarana Olahraga</option>
              <option value="SELASAR">Selasar</option>
              <option value="STUDIO">Studio</option>
              <option value="TAMAN">Taman</option>
            </select>
          </div>
        </div>
        --}}

        {{--
        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label  fw-bold fs-6">{{ __('Klasifikasi Ruangan') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-2 fv-row">
            <input type="text" name="floor_classification" class="form-control form-control-lg"
              value="{{ old('number', $floor->floor_classification ?? '') }}" />
          </div>
          <!--end::Col-->

          <!--begin::Col-->
          <div class="col-lg-4 fv-row">
            <input type="text" name="room_classification" class="form-control form-control-lg"
              value="{{ old('number', $floor->room_classification ?? '') }}" />
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->
        --}}

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Lantai') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-2 fv-row">
            <input type="text" name="number" class="form-control form-control-lg"
              value="{{ old('number', $floor->number ?? '') }}" />
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Gedung') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-6 fv-row">
                <select id="building_id" name="building_id" class="form-control form-control-lg">
                    <option value="{{ old('building_id', $floor->building_id ?? '') }}" selected>{{ old('gedung', $floor->gedung ?? '') }}</option>
                    <option disabled><br></option>
                    @foreach($buildings as $building)
                        <option value="{{ $building->id }}" data-kode="{{ $building->kode_gedung }}" data-gedung="{{ $building->name }}">{{ $building->name }}</option>
                    @endforeach
                </select>
            </div>
            <!--end::Col-->
        </div>
        <!-- Hidden input to store -->
        <input type="hidden" name="gedung" id="gedung" value="{{ old('gedung', $floor->gedung ?? '') }}" />
        <input type="hidden" name="kode_ruang" id="kode_ruang" value="{{ old('kode_ruang', $floor->kode_ruang ?? '') }}" />

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label  fw-bold fs-6">{{ __('Uraian Ruangan') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-6 fv-row">
            <input type="text" name="room_description" class="form-control form-control-lg"
              value="{{ old('number', $floor->room_description ?? '') }}" />
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->


        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">
            <span>{{ __('Luas') }}</span>
          </label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="row col-lg-8">
            <!--begin::Col-->
            <div class="fv-row col-lg-3">
              <div class="input-group input-group mb-2">
                <input type="number" min="1" id="large" name="large"
                  class="form-control form-control-lg  mb-lg-0 mb-3"
                  value="{{ old('number', $floor->large ?? '') }}" />
                <span class="input-group-text" id="basic-addon2">m<sup>2</sup></span>
              </div>
            </div>
            <!--end::Col-->

            <!--begin::Label-->
            <label class="col-lg-2 col-form-label fw-bold fs-6">
              <span>{{ __('Kapasitas') }}</span>
            </label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-3 mb-2">
              <div class="input-group input-group">
                <input type="number" min="1" id="capacity" name="capacity"
                  class="form-control form-control-lg  mb-lg-0 mb-3"
                  value="{{ old('number', $floor->capacity ?? '') }}" />
                <span class="input-group-text" id="basic-addon2">Orang</span>
              </div>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->
      </div>
      <!--end::Card body-->

      <!--begin::Actions-->
      <div class="card-footer d-flex justify-content-end px-9 py-6">
        <a href="{{ route('floor.building') }}" type="reset"
          class="btn btn-white btn-active-light-primary me-2">{{ __('Kembali') }}</a>
        <button type="button" class="btn btn-primary" id="kt_floor_create_submit">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#kategori_ruangan').select2();
        $('#building_id').select2();
        
        $('#building_id').change(function() {
            var selectedOption = $(this).find(':selected');
            var gedung = selectedOption.data('gedung');            
            var kodeRuang = selectedOption.data('kode');

            $('#gedung').val(gedung);
            $('#kode_ruang').val(kodeRuang);
      });
    });
</script>