<!--begin::Basic info-->
<div class="card {{ $class }}">
  <!--begin::Card header-->
  <div class="card-header rotate cursor-pointer border-0" role="button" data-bs-toggle="collapse"
    data-bs-target="#kt_layanan_layanan_create" aria-expanded="true" aria-controls="kt_layanan_layanan_create">
    <!--begin::Card title-->
    <div class="card-title m-0">
      <h3 class="fw-bolder m-0">{{ __('Tambah Layanan') }}</h3>
    </div>
    <!--end::Card title-->
  </div>
  <!--begin::Card header-->

  <!--begin::Content-->
  <div id="kt_layanan_layanan_create" class="show collapse">
    <!--begin::Form-->
    <form id="kt_layanan_layanan_create_form" class="form" method="POST" action="{{ route('layanan.store') }}"
      enctype="multipart/form-data">
      @csrf
      <!--begin::Card body-->
      <div class="card-body border-top p-9">
        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">
            <span>{{ __('Jenis Layanan') }}</span>
          </label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-3 fv-row">
            <select id="type" name="type" aria-label="{{ __('Pilih Jenis Layanan') }}"
              data-placeholder="{{ __('Pilih Jenis...') }}"
              class="form-select form-select form-select-lg fw-bold">
              <option value="">{{ __('Pilih Jenis...') }}</option>
            </select>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Nama Layanan') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-8 fv-row">
            <input type="text" name="name" class="form-control form-control-lg" />
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">
            <span>{{ __('Alamat') }}</span>
          </label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-8 fv-row">
            <textarea id="address" name="address" class="form-control form-control-lg"></textarea>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">
            <span>{{ __('Lokasi') }}</span>
          </label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-3 fv-row">
            <select id="location" name="location" aria-label="{{ __('Pilih Lokasi') }}"
              data-placeholder="{{ __('Pilih Lokasi...') }}"
              class="form-select form-select form-select-lg fw-bold">
              <option value="">{{ __('Pilih Lokasi...') }}</option>
            </select>
          </div>
          <!--end::Col-->

          <!--begin::Col-->
          <!--
          <div class="col-lg-3 fv-row">
            <select name="location" aria-label="{{ __('Pilih Lokasi') }}" data-control="select2"
              data-placeholder="{{ __('Pilih Lokasi...') }}"
              class="form-select form-select-solid form-select-lg fw-bold">
              <option value="">{{ __('Pilih Lokasi...') }}</option>
              <option value="GANESHA">
                {{ __('ITB KAMPUS GANESHA') }}
              </option>
              <option value="SARAGA">
                {{ __('SARAGA') }}
              </option>
              <option value="JATINANGOR">
                {{ __('ITB KAMPUS JATINANGOR') }}
              </option>
              <option value="CIREBON">
                {{ __('ITB KAMPUS CIREBON') }}
              </option>
              <option value="SBM JAKARTA">
                {{ __('ITB KAMPUS JAKARTA') }}
              </option>
              <option value="BOSSCHA">
                {{ __('BOSSCHA') }}
              </option>
            </select>
          </div>
          -->
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">
            <span>{{ __('Unit Pengelola') }}</span>
          </label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-8 fv-row">
            <input type="text" value="{{ auth()->user()->itb_unit }}" disabled="disabled" class="form-control form-control-lg" />
            <input type="hidden" name="unit_pengelola" id="unit_pengelola" value="{{ auth()->user()->itb_unit }}">
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">
            <span>{{ __('Kapasitas') }}</span>
          </label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-8">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->
              <div class="col-lg-4 fv-row mb-2">
                <div class="input-group input-group">
                  <input type="number" min="1" id="capacity" name="capacity"
                    class="form-control form-control-lg mb-lg-0 mb-3" value="0" />
                  <span class="input-group-text" id="basic-addon2">Orang</span>
                </div>
              </div>
              <!--end::Col-->

              <!--begin::Label-->
              <label class="col-lg-2 col-form-label fw-bold fs-6">
                <span id="label-large">{{ __('Luas') }}</span>
              </label>
              <!--end::Label-->

              <!--begin::Col-->
              <div class="col-lg-4">
                <div class="input-group input-group fv-row mb-2" id="div-large">
                  <input type="number" min="1" id="large" name="large"
                    class="form-control form-control-lg mb-lg-0 mb-3" value="0" />
                  <span class="input-group-text" id="basic-addon2">m<sup>2</sup></span>
                </div>
              </div>
              <!--end::Col-->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->
        
        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">
            <span>{{ __('Tipe') }}</span>
          </label>
          <!--end::Label-->
          <!--begin::Col-->
          <div class="col-lg-4 fv-row">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="service_type" id="layanan_radio" value="Layanan" checked>
              <label class="form-check-label" for="layanan_radio">
                Layanan
              </label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="service_type" id="resource_sharing_radio" value="Resource Sharing">
              <label class="form-check-label" for="resource_sharing_radio">
              <i>Resource Sharing</i>
              </label>
            </div>
          </div>
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">
            <span>{{ __('Harga') }}</span>
          </label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-8 fv-row">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->
              <div class="col-lg-4 fv-row">
                <input type="text" id="price" name="price"
                  class="form-control form-control-lg mb-lg-0 mb-3" />
              </div>
              <!--end::Col-->

              <!--begin::Label-->
              <label class="col-lg-2 col-form-label fw-bold fs-6">
                {{ __('Per') }}</span>
              </label>
              <!--end::Label-->

              <!--begin::Col-->
              <div class="col-lg-4 fv-row">
                <select name="price_for" aria-label="{{ __('Pilih Harga Per') }}" data-control="select2"
                  data-placeholder="{{ __('Pilih Harga Per...') }}"
                  class="form-select form-select form-select-lg fw-bold">
                  <option value=""></option>
                  <option value="HARI">{{ __('Hari') }}</option>
                  <option value="JAM">{{ __('Jam') }}</option>
                </select>
              </div>
              <!--end::Col-->
            </div>
            <!--end::Row-->
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Keterangan') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-8 fv-row">
            <input type="hidden" name="description" id="description">
            <textarea id="editor_description" name="editor_description" class="form-control form-control-lg"></textarea>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Status') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-8 fv-row">
            <!--begin::Options-->
            <div class="d-flex align-items-center mt-3">
              <!--begin::Option-->
              <label class="form-check form-check-inline form-check me-5">
                <input class="form-check-input" name="status" type="radio" value="AKTIF" checked />
                <span class="fw-bold fs-6 ps-2">
                  {{ __('AKTIF') }}
                </span>
              </label>
              <!--end::Option-->

              <!--begin::Option-->
              <label class="form-check form-check-inline form-check me-5">
                <input class="form-check-input" name="status" type="radio" value="PILIH" id="pilihRadio" />
                <span class="fw-bold fs-6 ps-2">
                  {{ __('TIDAK AKTIF') }}
                </span>
              </label>
              <!--end::Option-->

              <!--begin::Select-->
              <select name="status" class="form-select ms-5" id="statusSelect" style="display:none; width: 200px;">
                <option value="AKTIF" hidden>{{ __('PILIH ALASAN') }}</option>
                <option value="RUSAK">{{ __('RUSAK') }}</option>
                <option value="TIDAK BISA DISEWA">{{ __('TIDAK BISA DISEWA') }}</option>
              </select>
              <!--end::Select-->
            </div>
            <!--end::Options-->
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

{{--
        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Status') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-8 fv-row">
            <!--begin::Options-->
            <div class="d-flex align-items-center mt-3">
              <!--begin::Option-->
              <label class="form-check form-check-inline form-check me-5">
                <input class="form-check-input" name="status" type="radio" value="AKTIF" checked />
                <span class="fw-bold fs-6 ps-2">
                  {{ __('AKTIF') }}
                </span>
              </label>
              <!--end::Option-->

              <!--begin::Option-->
              <label class="form-check form-check-inline form-check">
                <input class="form-check-input" name="status" type="radio" value="TIDAK AKTIF" />
                <span class="fw-bold fs-6 ps-2">
                  {{ __('TIDAK AKTIF') }}
                </span>
              </label>
              <!--end::Option-->

              <!--begin::Option-->
              <label class="form-check form-check-inline form-check">
                <input class="form-check-input" name="status" type="radio" value="RUSAK" />
                <span class="fw-bold fs-6 ps-2">
                  {{ __('RUSAK') }}
                </span>
              </label>
              <!--end::Option-->

              <!--begin::Option-->
              <label class="form-check form-check-inline form-check">
                <input class="form-check-input" name="status" type="radio" value="TIDAK BISA DISEWA" />
                <span class="fw-bold fs-6 ps-2">
                  {{ __('TIDAK DISEWA') }}
                </span>
              </label>
              <!--end::Option-->
            </div>
            <!--end::Options-->
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->
--}}

        <div class="separator my-10"></div>

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">
            <span>{{ __('Gambar') }}</span>
          </label>
          <!--end::Label-->

          <div class="col-lg-8 fv-row">
            <input type="file" name="layanan_gambar" id="layanan_gambar" multiple hidden>
            <!--begin::Dropzone-->
            <div class="dropzone" id="layanan_gambar_upload">
              <!--begin::Message-->
              <div class="dz-message needsclick">
                <div class="ms-4">
                  <h3 class="fs-5 fw-bold mb-1 text-gray-900">Drop files here or click to upload.
                  </h3>
                </div>
              </div>
            </div>
            <!--end::Dropzone-->
            <span class="fs-7 fw-semibold text-gray-400">Max Upload 10 gambar, Ukuran per gambar max 2MB </span>
          </div>
        </div>
        <!--end::Input group-->

        <div class="separator my-10"></div>

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">
            <span>{{ __('Fasilitas') }}</span>
          </label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-8 fv-row">
            <!--begin::Repeater-->
            <div id="facility">
              <!--begin::Form group-->
              <div class="form-group">
                <div data-repeater-list="facility">
                  <div data-repeater-item>
                    <div class="form-group row mb-5">
                      <div class="col-md-4">
                        <label class="form-label">Fasilitas:</label>
                        <select class="form-select" name="facility_id"
                          data-kt-repeater="select2-facility" data-placeholder="Pilih Fasilitas">
                        </select>
                      </div>
                      <div class="col-md-2">
                        <label class="form-label">Jenis:</label>
                        <select name="type" aria-label="{{ __('Pilih Jenis') }}" data-kt-repeater="select2"
                          data-placeholder="Pilih" class="form-select form-select">
                          <option value="UTAMA">{{ __('Utama') }}</option>
                          <option value="TAMBAHAN">{{ __('Tambahan') }}</option>
                        </select>
                      </div>
                      <div class="col-md-2">
                        <label class="form-label">Qty:</label>
                        <input type="text" min="1" name="quantity" value=1
                          class="form-control mb-2 mb-md-0" />
                      </div>
                      <div class="col-md-3">
                        <label class="form-label">Biaya:</label>
                        <input type="text" name="fee" class="form-control mb-2 mb-md-0"
                          value=0 />
                      </div>
                      <div class="col-md-1">
                        <a href="javascript:;" data-repeater-delete
                          class="btn btn-flex btn-light-danger mt-3 mt-md-9 align-items-center">
                          <i class="bi bi-trash"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--end::Form group-->

              <!--begin::Form group-->
              <div class="form-group">
                <a href="javascript:;" data-repeater-create class="btn btn-flex btn-light-primary">
                  Tambah
                </a>
              </div>
              <!--end::Form group-->
              <br>
              <span class="fs-7 fw-semibold text-gray-400">Abaikan "Pilih Fasilitas" jika layanan tidak ada fasilitas.</span>
            </div>
            <!--end::Repeater-->
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

      </div>
      <!--end::Card body-->


      <!--begin::Actions-->
      <div class="card-footer d-flex justify-content-end px-9 py-6">
        <a href="{{ route('layanan.index') }}" type="reset"
          class="btn btn-white btn-active-light-primary me-2">{{ __('Kembali') }}</a>

        <button type="button" class="btn btn-primary" id="kt_layanan_layanan_create_submit">
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

<!-- begin::Script -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  $(document).ready(function () {
    // Sembunyikan semua tombol delete pada awalnya
    $('#facility [data-repeater-delete]').hide();

    // Tambahkan event listener untuk setiap tombol "Tambah"
    $('#facility [data-repeater-create]').on('click', function () {
      // Sembunyikan tombol delete pada elemen yang baru ditambahkan
      $(this).closest('#facility').find('[data-repeater-delete]').show();

      // Sembunyikan tombol delete pada elemen pertama
      $(this).closest('#facility').find('[data-repeater-item]:first-child [data-repeater-delete]').hide();
    });
  });
  
</script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Ketika pilihan diubah
    document.querySelectorAll('input[name="service_type"]').forEach(function(radio) {
      radio.addEventListener('change', function() {
        var priceInput = document.getElementById('price');
        if (this.value === 'Resource Sharing') {
          priceInput.value = '0'; // Set nilai 0
          priceInput.disabled = true; // Nonaktifkan input
          priceInput.style.backgroundColor = '#f0f0f0'; // Warna abu-abu
        } else {
          priceInput.value = ''; // Hapus nilai
          priceInput.disabled = false; // Aktifkan input
          priceInput.style.backgroundColor = '#fff'; // Warna normal
        }
      });
    });
  });

  document.addEventListener('DOMContentLoaded', function() {
    const pilihRadio = document.getElementById('pilihRadio');
    const statusSelect = document.getElementById('statusSelect');

    pilihRadio.addEventListener('change', function() {
      if (this.checked) {
        statusSelect.style.display = 'block';
      }
    });

    // Hide select dropdown if another radio is selected
    const otherRadios = document.querySelectorAll('input[name="status"]:not(#pilihRadio)');
    otherRadios.forEach(radio => {
      radio.addEventListener('change', function() {
        if (this.checked) {
          statusSelect.style.display = 'none';
        }
      });
    });
  });
</script>
<!--end::Script-->
