<!--begin::Navbar-->
<div class="card {{ $class }}">
  <div class="card-body pt-9 pb-0">
    <!--begin::Details-->
    <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
      <!--begin: Pic-->
      <div class="me-7 mb-4">
        <div class="symbol symbol-200px symbol-lg-400px symbol-fixed position-relative">
          <img src="{{ asset($reservation->layanan->layanan_gambars->first()->picture) }}" alt="image" />
        </div>
      </div>
      <!--end::Pic-->

      <!--begin::Info-->
      <div class="flex-grow-1">
        <!--begin::Title-->
        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
          <!--begin::User-->
          <div class="d-flex flex-column">
            <!--begin::Name-->
            <div class="d-flex align-items-center mb-2">
              <a href="#"
                class="text-gray-800 text-hover-primary fs-2 fw-bolder me-1">{{ $reservation->layanan->name }}</a>
            </div>
            <!--end::Name-->

            <!--begin::Info-->
            <div class="d-flex flex-wrap fw-bold fs-6 pe-2">
              <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                {!! theme()->getSvgIcon('icons/duotune/general/gen018.svg', 'svg-icon-4 me-1') !!}
                {{ $reservation->layanan->address }}
              </a>
            </div>
            <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
              <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                {!! theme()->getSvgIcon('icons/duotune/general/gen018.svg', 'svg-icon-4 me-1') !!}
                {{ $reservation->layanan->location }}
              </a>
            </div>
            <!--end::Info-->
          </div>
          <!--end::User-->
        </div>
        <!--end::Title-->

        <!--begin::Stats-->
        <div class="d-flex flex-wrap flex-stack">
          <!--begin::Wrapper-->
          <div class="d-flex flex-column flex-grow-1 pe-8">
            <!--begin::Stats-->
            <div class="d-flex flex-wrap">
              <!--begin::Stat-->
              <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                <!--begin::Number-->
                <div class="d-flex align-items-center">
                  <div class="fs-2 fw-bolder" data-kt-countup="true"
                    data-kt-countup-value="{{ $reservation->layanan->price }}" data-kt-countup-prefix="Rp. "
                    data-kt-countup-suffix=" / {{ $reservation->layanan->price_for }}">0</div>
                </div>
                <!--end::Number-->

                <!--begin::Label-->
                <div class="fw-bold fs-6 text-gray-400">{{ __('Harga') }}</div>
                <!--end::Label-->
              </div>
              <!--end::Stat-->
            </div>
            <!--end::Stats-->
          </div>
          <!--end::Wrapper-->
        </div>
        <!--end::Stats-->
      </div>
      <!--end::Info-->
    </div>
    <!--end::Details-->
  </div>
</div>
<!--end::Navbar-->

<!--begin::details View-->
<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
  <!--begin::Card header-->
  <div class="card-header cursor-pointer">
    <!--begin::Card title-->
    <div class="card-title m-0">
      <h3 class="fw-bolder m-0">{{ __('Detail Sewa') }}</h3>
    </div>
    <!--end::Card title-->

    <!--begin::Action-->
    @if (!in_array($reservation->status, ['DITERIMA', 'DIBATALKAN']))
      <div class="d-flex my-4">
        <a href="#" id="approveButton"
          class="btn btn-sm btn-success align-self-center me-2">{{ __('Setuju') }}</a>
        <a href="#" id="rejectButton" class="btn btn-sm btn-danger align-self-center">{{ __('Tolak') }}</a>
      </div>
    @endif
    <!--end::Action-->
  </div>
  <!--begin::Card header-->

  <!--begin::Card body-->
  <div class="card-body p-9">
    <!--begin::Row-->
    <div class="row">
      <div class="col-lg-6">
        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 fw-bold text-muted">{{ __('Penyewa') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-4">
            <span class="fw-bolder fs-6 text-dark">{{ $reservation->created_by }}</span>
          </div>
          <!--end::Col-->
        </div>

        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 fw-bold text-muted">{{ __('Tanggal Mulai') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-4">
            <span class="fw-bolder fs-6 text-dark">
              {{ date('d-m-Y', strtotime($reservation->start_date)) }}
            </span>
          </div>
          <!--end::Col-->
        </div>

        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 fw-bold text-muted">{{ __('Tanggal Selesai') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-4">
            <span class="fw-bolder fs-6 text-dark">
              {{ date('d-m-Y', strtotime($reservation->end_date)) }}
            </span>
          </div>
          <!--end::Col-->
        </div>

        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 fw-bold text-muted">{{ __('Biaya') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-4">
            <div class="fs-6 fw-bolder text-dark" data-kt-countup="true"
              data-kt-countup-value="{{ $reservation->fee }}" data-kt-countup-prefix="Rp. ">
              0
            </div>
          </div>
          <!--end::Col-->
        </div>

        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 fw-bold text-muted">{{ __('Biaya Tambahan') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-4">
            <div class="fs-6 fw-bolder text-dark" data-kt-countup="true"
              data-kt-countup-value="{{ $reservation->extra_fee }}" data-kt-countup-prefix="Rp. ">
              0
            </div>
          </div>
          <!--end::Col-->
        </div>

        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 fw-bold text-muted">{{ __('Total') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-4">
            <div class="fs-6 fw-bolder text-dark" data-kt-countup="true"
              data-kt-countup-value="{{ $reservation->total }}" data-kt-countup-prefix="Rp. ">
              0
            </div>
          </div>
          <!--end::Col-->
        </div>

        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 fw-bold text-muted">{{ __('Status') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-4">
            <span class="fw-bolder fs-6 text-dark">{{ $reservation->status }}</span>
          </div>
          <!--end::Col-->
        </div>

        <div class="row mb-6">
          <!--begin::Label-->
          <label class="col-lg-4 fw-bold text-muted">{{ __('Receipt') }}</label>
          <!--end::Label-->

          <!--begin::Col-->
          <div class="col-lg-4">
            <a href="{{ asset($reservation->receipt) }}" class="btn btn-sm btn-success"><i
                class="fas fa-envelope-open-text fs-4 me-2"></i> Download</a>
          </div>
          <!--end::Col-->
        </div>
      </div>

      <div class="col-lg-4">
        <h3 class="card-title align-items-start flex-column">
          <span class="card-label fw-bolder text-dark">Fasilitas Tambahan</span>
        </h3>
        @if (count($extraFacilities) > 0)
          @foreach ($extraFacilities as $extraFacility)
            <!--begin::Section-->
            <div class="d-flex align-items-center flex-row-fluid flex-wrap mb-2">
              <div class="flex-grow-1 me-2">
                <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder">
                  {{ $extraFacility->facility->name }}
                </a>

                <span class="text-muted fw-bold d-block fs-7">
                  {{ $extraFacility->facility->fee_for }} {{ $extraFacility->facility->satuan }}
                </span>
              </div>

              <span class="badge badge-light fw-bolder my-2 text-dark">Rp.
                {{ number_format($extraFacility->fee, 0) }}</span>
            </div>
            <!--end::Section-->
          @endforeach
        @else
          <span class="fw-bolder fs-6 text-dark">Tidak Ada.</span>
        @endif
      </div>
    </div>
    <!--end::Row-->
  </div>
  <!--end::Card body-->
</div>
<!--end::details View-->
