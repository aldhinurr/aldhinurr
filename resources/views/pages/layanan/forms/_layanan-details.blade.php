<?php
// 'AKTIF','TIDAK AKTIF','RUSAK','TIDAK BISA DISEWA','DIHAPUS'
$status_color = [
  'AKTIF' => 'success',
  'TIDAK AKTIF' => 'secondary',
  'RUSAK' => 'warning',
  'TIDAK BISA DISEWA' => 'info',
  'DIHAPUS' => 'danger',
];
?>

<!--begin::Basic info-->
<div class="card {{ $class }}">
  <!--begin::Card header-->
  <div class="card-header rotate cursor-pointer border-0" role="button" data-bs-toggle="collapse" data-bs-target="#kt_layanan_layanan_details" aria-expanded="true" aria-controls="kt_layanan_layanan_details">
    <!--begin::Card title-->
    <div class="card-title m-0">
      <h3 class="fw-bolder m-0">{{ __('Detail Layanan') }}</h3>
    </div>
    <!--end::Card title-->
  </div>
  <!--begin::Card header-->

  <!--begin::Content-->
  <div id="kt_layanan_layanan_details" class="show collapse">
    <!--begin::Card body-->
    <div class="card-body border-top p-9">

      <!--begin::Input group-->
      <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Jenis Layanan') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-4 fv-row">
          <span class="fw-bolder fs-6 text-dark">{{ $layanan->type }}</span>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->

      <!--begin::Input group-->
      <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Nama Layanan') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8 fv-row">
          <span class="fw-bolder fs-6 text-dark">{{ $layanan->name }}</span>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->

      <!--begin::Input group-->
      <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Keterangan') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8 fv-row">
          <article class="fw-bolder fs-6 text-dark">
            {!! $layanan->description !!}
          </article>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->

      <!--begin::Input group-->
      <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Alamat') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8 fv-row">
          <span class="fw-bolder fs-6 text-dark">{{ $layanan->address }}</span>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->

      <!--begin::Input group-->
      <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Lokasi') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8 fv-row">
          <span class="fw-bolder fs-6 text-dark">{{ $layanan->location }}</span>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->


      <!--begin::Input group-->
      <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-4 fw-bold text-muted">{{ __('Harga') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-2 fv-row">
          <div class="fs-6 fw-bolder text-dark" data-kt-countup="true" data-kt-countup-value="{{ $layanan->price }}" data-kt-countup-prefix="Rp. " data-kt-countup-suffix=" / {{ $layanan->price_for }}">
            0
          </div>
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
          <span class="badge badge-light-{{ $status_color[$layanan->status] }}">
            {{ $layanan->status }}
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

<!--begin::Basic info-->
<div class="card {{ $class }}">
  <!--begin::Card header-->
  <div class="card-header rotate cursor-pointer border-0" role="button" data-bs-toggle="collapse" data-bs-target="#kt_layanan_layanan_gambars" aria-expanded="true" aria-controls="kt_layanan_layanan_gambars">
    <!--begin::Card title-->
    <div class="card-title m-0">
      <h3 class="fw-bolder m-0">{{ __('Layanan Pictures') }}</h3>
    </div>
    <!--end::Card title-->
  </div>
  <!--begin::Card header-->

  <!--begin::Content-->
  <div id="kt_layanan_layanan_gambars" class="show collapse">
    <!--begin::Card body-->
    <div class="card-body border-top p-9">
      <div class="row">
        @foreach ($gambars as $img)
        <!--begin::Col-->
        <div class="col-lg-3 p-3">
          <!--begin::Overlay-->
          <a class="d-block overlay" data-fslightbox="lightbox-basic" href="{{ asset($img['picture']) }}">
            <!--begin::Image-->
            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-250px" style="background-image:url('{{ asset($img['picture']) }}')">
            </div>
            <!--end::Image-->

            <!--begin::Action-->
            <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
              <i class="bi bi-eye-fill fs-3x text-white"></i>
            </div>
            <!--end::Action-->
          </a>
          <!--end::Overlay-->
        </div>
        <!--end::Col-->
        @endforeach
      </div>
    </div>
    <!--end::Card body-->
  </div>
  <!--end::Content-->
</div>
<!--end::Basic info-->