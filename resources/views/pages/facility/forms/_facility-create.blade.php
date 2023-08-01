<!--begin::Basic info-->
<div class="card {{ $class }}">
  <!--begin::Card header-->
  <div class="card-header rotate cursor-pointer border-0" role="button" data-bs-toggle="collapse"
    data-bs-target="#kt_facility_create" aria-expanded="true" aria-controls="kt_facility_create">
    <!--begin::Card title-->
    <div class="card-title m-0">
      <h3 class="fw-bolder m-0">{{ __('Tambah Fasilitas') }}</h3>
    </div>
    <!--end::Card title-->
  </div>
  <!--begin::Card header-->

  <!--begin::Content-->
  <div id="kt_facility_create" class="show collapse">
    <!--begin::Form-->
    <form id="kt_facility_create_form" class="form" method="POST" action="{{ route('facility.store') }}"
      enctype="multipart/form-data">
      @csrf
      <!--begin::Card body-->
      <div class="card-body border-top p-9">

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Nama Fasilitas') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-8 fv-row">
            <input type="text" name="name" class="form-control form-control-lg form-control-solid" />
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 col-form-label fw-bold fs-6">
            <span class="required">{{ __('Satuan') }}</span>
          </label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-4 fv-row">
            <select name="satuan" aria-label="{{ __('Pilih Satuan') }}" data-control="select2"
              data-placeholder="{{ __('Pilih Satuan...') }}"
              class="form-select form-select-solid form-select-lg fw-bold">
              {{-- <option value="">{{ __('Pilih Satuan...') }}</option> --}}
              <option value="UNIT">
                {{ __('UNIT') }}
              </option>
              <option value="M2">
                {{ __('M2') }}
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
            <span class="required">{{ __('Icon') }}</span>
          </label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-4 fv-row">
            {{-- <input type="text" name="icon" class="form-control form-control-lg form-control-solid" placeholder="Nama Icon" /> --}}
            <select id="icon" name="icon" aria-label="{{ __('Pilih Icon') }}" data-control="select2"
              data-placeholder="{{ __('Pilih Icon...') }}"
              class="form-select form-select-solid form-select-lg fw-bold">
              @foreach ($icons as $icon)
                <option value="{{ $icon['name'] }}" data-kt-select2-icon="{{ $icon['icon'] }}">
                  {{ $icon['name'] }}
                </option>
              @endforeach
            </select>
            <div class="form-text"><a href="https://icons8.com/line-awesome" target="_blank"
                rel="noopener noreferrer">Lihat daftar icon</a></div>
          </div>
          <!--end::Col-->
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
        <a href="{{ route('facility.index') }}" type="reset"
          class="btn btn-white btn-active-light-primary me-2">{{ __('Kembali') }}</a>
        <button type="button" class="btn btn-primary" id="kt_facility_create_submit">
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
