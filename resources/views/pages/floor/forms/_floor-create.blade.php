<!--begin::Basic info-->
<div class="card {{ $class }}">
  <!--begin::Card header-->
  <div class="card-header rotate cursor-pointer border-0" role="button" data-bs-toggle="collapse"
    data-bs-target="#kt_floor_create" aria-expanded="true" aria-controls="kt_floor_create">
    <!--begin::Card title-->
    <div class="card-title m-0">
      <h3 class="fw-bolder m-0">{{ __('Gedung ') . $building->name }}</h3>
      <!--begin::Separator-->
      <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
      <!--end::Separator-->

      <!--begin::Description-->
      <small class="text-muted fs-7 fw-bold my-1 ms-1">
        {{ __('Tambah Data Lantai & Ruang') }}
      </small>
      <!--end::Description-->
    </div>
    <!--end::Card title-->
  </div>
  <!--begin::Card header-->

  <!--begin::Content-->
  <div id="kt_floor_create" class="show collapse">
    <!--begin::Form-->
    <form id="kt_floor_create_form" class="form" method="POST" action="{{ route('floor.store') }}">
      @csrf
      <!--begin::Card body-->
      <div class="card-body border-top p-9">
        {{-- building id --}}
        <input type="hidden" name="building_id" id="building_id" value="{{ $building->id }}">

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label required fw-bold fs-6">{{ __('Lantai') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-2 fv-row">
            <input type="text" name="number" class="form-control form-control-lg form-control-solid" />
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label required fw-bold fs-6">{{ __('Klasifikasi Ruangan') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-2 fv-row">
            <input type="text" name="floor_classification" class="form-control form-control-lg form-control-solid" />
          </div>
          <!--end::Col-->

          <!--begin::Col-->
          <div class="col-lg-4 fv-row">
            <input type="text" name="room_classification" class="form-control form-control-lg form-control-solid" />
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label required fw-bold fs-6">{{ __('Uraian Ruangan') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-6 fv-row">
            <input type="text" name="room_description" class="form-control form-control-lg form-control-solid" />
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->


        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">
            <span class="required">{{ __('Luas') }}</span>
          </label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="row col-lg-8">
            <!--begin::Col-->
            <div class="fv-row col-lg-3">
              <div class="input-group input-group-solid mb-2">
                <input type="number" min="1" id="large" name="large"
                  class="form-control form-control-lg form-control-solid mb-lg-0 mb-3"
                  aria-describedby="basic-addon2" />
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
              <div class="input-group input-group-solid">
                <input type="number" min="1" id="capacity" name="capacity"
                  class="form-control form-control-lg form-control-solid mb-lg-0 mb-3" />
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
        <a href="{{ route('building.floors', $building->id) }}" type="reset"
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
