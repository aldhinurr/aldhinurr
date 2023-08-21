<!--begin::Basic info-->
<div class="card {{ $class }}">
  <!--begin::Card header-->
  <div class="card-header rotate cursor-pointer border-0" role="button" data-bs-toggle="collapse"
    data-bs-target="#kt_laporan_details" aria-expanded="true" aria-controls="kt_laporan_details">
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
        <label class="col-lg-2 fw-bold text-muted">{{ __('Gambar Sebelum') }}</label>
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
                    style="background-image: url({{ asset($img['image']) }});">
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

      <div class="separator my-10"></div>

      <!--begin::Input group-->
      <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 fw-bold text-muted">{{ __('Update Terakhir') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-2">
          <span class="fw-bolder fs-6 text-dark">
            @if ($report->updated_at)
              {{ date('d-m-Y H:i:s', strtotime($report->updated_at)) }}
            @else
              Belum ada update.
            @endif
          </span>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->

      <!--begin::Input group-->
      <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 fw-bold text-muted">{{ __('Tanggal Selesai') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-2">
          <span class="fw-bolder fs-6 text-dark">
            @if ($report->tanggal_selesai)
              {{ date('d-m-Y', strtotime($report->tanggal_selesai)) }}
            @else
              Belum Selesai.
            @endif
          </span>
        </div>
        <!--end::Col-->
      </div>
      <!--end::Input group-->

      <!--begin::Input group-->
      <div class="row mb-6">
        <!--begin::Label-->
        <label class="col-lg-2 fw-bold text-muted">{{ __('Gambar Sesudah') }}</label>
        <!--end::Label-->

        <!--begin::Col-->
        <div class="col-lg-8 fv-row">
          @if (count($imagesAfter) > 0)
            <div class="row">
              @foreach ($imagesAfter as $img)
                <!--begin::Col-->
                <div class="col-lg-4 p-3">
                  <!--begin::Overlay-->
                  <a class="d-block overlay" data-fslightbox="lightbox-basic" href="{{ asset($img['image']) }}">
                    <!--begin::Image-->
                    <div
                      class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-250px"
                      style="background-image: url({{ asset($img['image']) }})">
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
          @else
            <span class="fw-bolder fs-6 text-dark">Belum tersedia.</span>
          @endif
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
  <div class="card-header rotate cursor-pointer border-0" role="button" data-bs-toggle="collapse"
    data-bs-target="#kt_report_update" aria-expanded="true" aria-controls="kt_report_update">
    <!--begin::Card title-->
    <div class="card-title m-0">
      <h3 class="fw-bolder m-0">{{ __('Update Laporan') }}</h3>
    </div>
    <!--end::Card title-->
  </div>
  <!--begin::Card header-->

  <!--begin::Content-->
  <div id="kt_report_update" class="show collapse">
    <!--begin::Form-->
    <form id="kt_report_update_form" class="form" method="POST" action="{{ route('report.update', $report->id) }}"
      enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <!--begin::Card body-->
      <div class="card-body border-top p-9">


        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">
            <span class="required">{{ __('Status') }}</span>
          </label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-4 fv-row">
            <select id="status" name="status" aria-label="{{ __('Pilih Status') }}"
              data-placeholder="{{ __('Pilih Status...') }}"
              class="form-select form-select-solid form-select-lg fw-bold">
            </select>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6" id="alasan_dialihkan_input" hidden>
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label required fw-bold fs-6">{{ __('Alasan Dialihkan') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-8 fv-row">
            <textarea id="alasan_dialihkan" name="alasan_dialihkan" class="form-control form-control-lg form-control-solid"
              rows="5"></textarea>
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">{{ __('Tanggal Selesai') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-4 fv-row">
            <input id="tanggal_selesai" name="tanggal_selesai"
              class="form-control form-control-lg form-control-solid" />
          </div>
          <!--end::Col-->
        </div>
        <!--end::Input group-->


        <!--begin::Input group-->
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-3 col-form-label fw-bold fs-6">
            {{ __('Gambar Sesudah') }}
          </label>
          <!--end::Label-->

          <div class="col-lg-8 fv-row">
            {{-- <input type="file" name="report_images" id="report_images" multiple hidden> --}}
            <!--begin::Dropzone-->
            <div class="dropzone" id="report_images_upload">
              <!--begin::Message-->
              <div class="dz-message needsclick">
                <div class="ms-4">
                  <h3 class="fs-5 fw-bold mb-1 text-gray-900">Drop files here or click to upload.
                  </h3>
                </div>
              </div>
            </div>
            <!--end::Dropzone-->
            <span class="fs-7 fw-semibold text-gray-400">Max Upload 10 gambar, Ukuran per gambar max 10MB </span>
          </div>
        </div>
        <!--end::Input group-->
      </div>
      <!--end::Card body-->

      <!--begin::Actions-->
      <div class="card-footer d-flex justify-content-end px-9 py-6">
        <a href="{{ route('report.index') }}" type="reset"
          class="btn btn-white btn-active-light-primary me-2">{{ __('Kembali') }}</a>
        <button type="button" class="btn btn-primary" id="kt_report_update_submit">
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
