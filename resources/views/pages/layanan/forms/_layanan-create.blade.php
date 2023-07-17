<!--begin::Basic info-->
<div class="card {{ $class }}">
  <!--begin::Card header-->
  <div class="card-header rotate cursor-pointer border-0" role="button" data-bs-toggle="collapse"
    data-bs-target="#kt_layanan_layanan_create" aria-expanded="true" aria-controls="kt_layanan_layanan_create">
    <!--begin::Card title-->
    <div class="card-title m-0">
      <h3 class="fw-bolder m-0">{{ __('New Layanan') }}</h3>
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
          <label class="col-lg-4 col-form-label fw-bold fs-6">
            <span class="required">{{ __('Jenis Layanan') }}</span>
          </label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-4 fv-row">
            <select name="type" aria-label="{{ __('Pilih Jenis Layanan') }}" data-control="select2"
              data-placeholder="{{ __('Pilih Jenis Layanan...') }}"
              class="form-select form-select-solid form-select-lg fw-bold">
              <option value="">{{ __('Pilih Jenis...') }}</option>
              <option value="RUANG">
                {{ __('Ruang') }}
              </option>
              <option value="KENDARAAN">
                {{ __('Kendaraan') }}
              </option>
            </select>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Nama Layanan') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-8 fv-row">
            <input type="text" name="name" class="form-control form-control-lg form-control-solid"
              placeholder="Nama Layanan" />
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Keterangan') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-8 fv-row">
            <input type="hidden" name="description" id="description">
            <textarea id="editor_description" name="editor_description" class="form-control form-control-lg form-control-solid"></textarea>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 col-form-label fw-bold fs-6">
            <span class="required">{{ __('Alamat') }}</span>
          </label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-8 fv-row">
            <textarea id="address" name="address" class="form-control form-control-lg form-control-solid"></textarea>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 col-form-label fw-bold fs-6">
            <span class="required">{{ __('Lokasi') }}</span>
          </label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-4 fv-row">
            <select name="location" aria-label="{{ __('Pilih Lokasi') }}" data-control="select2"
              data-placeholder="{{ __('Pilih Lokasi Layanan...') }}"
              class="form-select form-select-solid form-select-lg fw-bold">
              <option value="">{{ __('Pilih Lokasi Layanan...') }}</option>
              <option value="GANESHA">
                {{ __('GANESHA') }}
              </option>
              <option value="SARAGA">
                {{ __('SARAGA') }}
              </option>
              <option value="JATINANGOR">
                {{ __('JATINANGOR') }}
              </option>
              <option value="CIREBON">
                {{ __('CIREBON') }}
              </option>
            </select>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 col-form-label fw-bold fs-6">
            <span class="required">{{ __('Harga') }}</span>
          </label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-8 fv-row">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->
              <div class="col-lg-6 fv-row">
                <input type="text" id="price" name="price"
                  class="form-control form-control-lg form-control-solid mb-lg-0 mb-3" placeholder="Harga" />
              </div>
              <!--end::Col-->

              <!--begin::Label-->
              <label class="col-lg-1 col-form-label fw-bold fs-6">
                {{ __('Per') }}</span>
              </label>
              <!--end::Label-->

              <!--begin::Col-->
              <div class="col-lg-5 fv-row">
                <select name="price_for" aria-label="{{ __('Pilih Harga Per') }}" data-control="select2"
                  data-placeholder="{{ __('Pilih Harga Per...') }}"
                  class="form-select form-select-solid form-select-lg fw-bold">
                  <option value="JAM">
                    {{ __('Jam') }}
                  </option>
                  <option value="HARI">
                    {{ __('Hari') }}
                  </option>
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
          <label class="col-lg-4 col-form-label fw-bold fs-6">
            <span class="required">{{ __('Gambar') }}</span>
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
            <span class="fs-7 fw-semibold text-gray-400">Max Upload 10 gambar</span>
          </div>
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Status') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-8 fv-row">
            <!--begin::Options-->
            <div class="d-flex align-items-center mt-3">
              <!--begin::Option-->
              <label class="form-check form-check-inline form-check-solid me-5">
                <input class="form-check-input" name="status" type="radio" value="AKTIF" checked />
                <span class="fw-bold fs-6 ps-2">
                  {{ __('AKTIF') }}
                </span>
              </label>
              <!--end::Option-->

              <!--begin::Option-->
              <label class="form-check form-check-inline form-check-solid">
                <input class="form-check-input" name="status" type="radio" value="TIDAK AKTIF" />
                <span class="fw-bold fs-6 ps-2">
                  {{ __('TIDAK AKTIF') }}
                </span>
              </label>
              <!--end::Option-->

              <!--begin::Option-->
              <label class="form-check form-check-inline form-check-solid">
                <input class="form-check-input" name="status" type="radio" value="RUSAK" />
                <span class="fw-bold fs-6 ps-2">
                  {{ __('RUSAK') }}
                </span>
              </label>
              <!--end::Option-->

              <!--begin::Option-->
              <label class="form-check form-check-inline form-check-solid">
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

      </div>
      <!--end::Card body-->


      <!--begin::Actions-->
      <div class="card-footer d-flex justify-content-end px-9 py-6">
        <button type="reset" class="btn btn-white btn-active-light-primary me-2">{{ __('Discard') }}</button>

        <button type="button" class="btn btn-primary" id="kt_layanan_layanan_create_submit">
          @include('partials.general._button-indicator', ['label' => __('Save Changes')])
        </button>
      </div>
      <!--end::Actions-->
    </form>
    <!--end::Form-->
  </div>
  <!--end::Content-->
</div>
<!--end::Basic info-->
