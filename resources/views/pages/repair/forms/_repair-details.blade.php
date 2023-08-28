@php
// 'AKTIF','TIDAK AKTIF','RUSAK','TIDAK BISA DISEWA','DIHAPUS'
$status_color = [
  'AKTIF' => 'success',
  'TIDAK AKTIF' => 'secondary',
  'RUSAK' => 'warning',
  'TIDAK BISA DISEWA' => 'info',
  'DIHAPUS' => 'danger',
];
@endphp

<!--begin::Basic info-->
<div class="card {{ $class }}">
  <!--begin::Card header-->
  <div class="card-header rotate cursor-pointer border-0" role="button" data-bs-toggle="collapse" data-bs-target="#kt_facility_details" aria-expanded="true" aria-controls="kt_facility_details">
    <!--begin::Card title-->
    <div class="card-title m-0">
      <h3 class="fw-bolder m-0">{{ __('Detail Fasilitas') }}</h3>
    </div>
    <!--end::Card title-->
  </div>
  <!--begin::Card header-->

  <!--begin::Content-->
  <div id="kt_facility_details" class="show collapse">
    <!--begin::Card body-->
    <div class="card-body border-top p-9">

      <!--begin::Input group-->
      <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Nama Fasilitas') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8 fv-row">
          <span class="fw-bolder fs-6 text-dark">{{ $facility->name }}</span>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->

      <!--begin::Input group-->
      <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Satuan') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8 fv-row">
          <span class="fw-bolder fs-6 text-dark">{{ $facility->satuan }}</span>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->

      <!--begin::Input group-->
      <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Icon') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8 fv-row">
          <span class="fw-bolder fs-6 text-dark">{{ $facility->icon }}</span>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->
      
      <!--begin::Input group-->
      <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Status') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8 fv-row">
          <!--begin::Options-->
          <span class="badge badge-light-{{ $status_color[$facility->status] }}">
            {{ $facility->status }}
          </span>
          <!--end::Options-->
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->

    </div>
    <!--end::Card body-->
  </div>
  <!--end::Content-->
</div>
<!--end::Basic info-->