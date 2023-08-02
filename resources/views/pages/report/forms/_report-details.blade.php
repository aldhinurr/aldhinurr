<!--begin::Basic info-->
<div class="card {{ $class }}">
  <!--begin::Card header-->
  <div class="card-header rotate cursor-pointer">
    <!--begin::Card title-->
    <div class="card-title m-0">
      <h3 class="fw-bolder m-0">{{ __('Detail Laporan') }}</h3>
    </div>
    <!--end::Card title-->

    <!--begin::Action-->
    <div class="d-flex my-4">
      <a href="{{ route('report.index') }}"
        class="btn btn-sm btn-white btn-active-light-primary align-self-center me-2">{{ __('Kembali') }}</a>
    </div>
    <!--end::Action-->
  </div>
  <!--begin::Card header-->

  <!--begin::Content-->
  <div id="kt_laporan_details" class="show collapse">
    <!--begin::Card body-->
    <div class="card-body border-top p-9">


      <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 fw-bold text-muted">{{ __('Tanggal Laporan') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-2">
          <span class="fw-bolder fs-6 text-dark">
            {{ date('d-m-Y H:i:s', strtotime($report->created_at)) }}
          </span>
        </div>
        <!--end::Col-->
      </div>

      <!--begin::Input group-->
      <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 fw-bold text-muted">{{ __('Jenis Laporan') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-2 fv-row">
          <span class="fw-bolder fs-6 text-dark">{{ $report->jenis }}</span>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->

      <!--begin::Input group-->
      <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 fw-bold text-muted">{{ __('Keterangan') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8 fv-row">
          <article class="fw-bolder fs-6 text-dark">
            {!! $report->keterangan !!}
          </article>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->

      <!--begin::Input group-->
      <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 fw-bold text-muted">{{ __('Pelapor') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8 fv-row">
          <span class="fw-bolder fs-6 text-dark">{{ $report->user->first_name }} {{ $report->user->last_name }}</span>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->

      <!--begin::Input group-->
      <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 fw-bold text-muted">{{ __('Status') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8 fv-row">
          <span class="fw-bolder fs-6 text-dark">{{ $report->status }}</span>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->

      <!--begin::Input group-->
      <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 fw-bold text-muted">{{ __('Gambar') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8 fv-row">
          <div class="row">
            @foreach ($imagesBefore as $img)
              <!--begin::Col-->
              <div class="col-lg-4 p-3">
                <!--begin::Overlay-->
                <a class="d-block overlay" data-fslightbox="lightbox-basic" href="{{ asset($img['image']) }}">
                  <!--begin::Image-->
                  <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-250px"
                    style="background-image:url('{{ asset($img['image']) }}')">
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
        <!--end::Col-->
      </div>
      <!--end::Input group-->
    </div>
    <!--end::Card body-->
  </div>
  <!--end::Content-->
</div>
<!--end::Basic info-->
