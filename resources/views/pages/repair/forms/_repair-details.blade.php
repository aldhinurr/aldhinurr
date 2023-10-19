@php
  $status_color = [
      'Ajukan' => 'warning',
      'Draf' => 'secondary',
      'Sedang Direview' => 'info',
      'Tolak' => 'danger',
      'Setuju' => 'success',
  ];
@endphp

<!--begin::Basic info-->
<div class="card {{ $class }}">
  <!--begin::Card header-->
  <div class="card-header rotate cursor-pointer border-0" role="button" data-bs-toggle="collapse"
    data-bs-target="#kt_repair_details" aria-expanded="true" aria-controls="kt_repair_details">
    <!--begin::Card title-->
    <div class="card-title m-0">
      <h3 class="fw-bolder m-0">{{ __('Lihat Pengajuan Pemeliharaan / Perawatan') }}</h3>
    </div>
    <!--end::Card title-->
  </div>
  <!--begin::Card header-->

  <!--begin::Content-->
  <div id="kt_repair_details" class="show collapse">
    <!--begin::Card body-->
    <div class="card-body border-top p-9">

      <div class="row">
        <!--begin::Input group-->
        <div class="col-lg-6">
          <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Tanggal Buat') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
              <span class="fw-bolder fs-6 text-dark">{{ $repairService->created_at }}</span>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
        </div>

        <!--begin::Input group-->
        <div class="col-lg-6">
          <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Status') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
              <span class="badge badge-light-{{ $status_color[$repairService->status] }}">
                {{ $repairService->status }}
              </span>
            </div>
            <!--end::Col-->
          </div>
        </div>
        <!--end::Input group-->
      </div>

      <div class="row">
        <div class="col-lg-6">
          <!--begin::Input group-->
          <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Nama Lengkap') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
              <span class="fw-bolder fs-6 text-dark">{{ $repairService->user->first_name }}</span>
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
        </div>
        <div class="col-lg-6">
          <!--begin::Input group-->
          <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Unit Kerja') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
              <!--begin::Options-->
              <span class="fw-bolder fs-6 text-dark">{{ $repairService->unit }}</span>
              <!--end::Options-->
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <!--begin::Input group-->
          <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Judul') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
              <!--begin::Options-->
              <span class="fw-bolder fs-6 text-dark">{{ $repairService->title }}</span>
              <!--end::Options-->
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
        </div>
        <div class="col-lg-6">
          <!--begin::Input group-->
          <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Total') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
              <!--begin::Options-->
              <div class="fs-6 fw-bolder text-dark" data-kt-countup="true"
                data-kt-countup-value="{{ $repairService->total }}<" data-kt-countup-prefix="Rp. ">
                0
              </div>
              <!--end::Options-->
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <!--begin::Input group-->
          <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Nomor Surat') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
              <!--begin::Options-->
              <span class="fw-bolder fs-6 text-dark">{{ $repairService->nomor_surat }}</span>
              <!--end::Options-->
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
        </div>
        <div class="col-lg-6">
          <!--begin::Input group-->
          <div class="row mb-6">
            <!--begin::Label-->
            <label class="col-lg-4 fw-bold text-muted">{{ __('Attachment') }}</label>
            <!--end::Label-->

            <!--begin::Col-->
            <div class="col-lg-8 fv-row">
              <!--begin::Options-->
              @if ($repairService->attachment != null)
                <span class="fw-bolder fs-6 text-dark"><a href="{{ asset($repairService->attachment) }}"
                    target="_blank">Download</a></span>
              @else
                <span class="fw-bolder fs-6 text-dark">{{ __('Tidak ada.') }}</span>
              @endif
              <!--end::Options-->
            </div>
            <!--end::Col-->
          </div>
          <!--end::Input group-->
        </div>
      </div>

      <!--begin::Label-->
      <label class="col-lg-4 mt-5 fw-bold text-muted">{{ __('Detail Pengajuan Perbaikan') }}</label>
      <!--end::Label-->

      <!--begin::Table-->
      <div class="my-5">
        <table class="table align-middle table-row-dashed fs-7 gy-4" id="table-detail">
          <thead>
            <tr class="text-start fw-bold fs-6 text-uppercase gs-0">
              <th class="min-w-20px">No</th>
              <th class="min-w-100px">Gedung</th>
              <th class="text-center min-w-20px">Lantai</th>
              <th class="min-w-150px">Klasifikasi Ruangan</th>
              <th class="min-w-150px">Uraian Ruangan</th>
              <th class="min-w-80px">Total</th>
            </tr>
          </thead>
          <tbody class="fw-bold text-gray-600">
            @php
              $number = 1;
            @endphp
            @foreach ($repairServiceDetails as $detail)
              <tr>
                <td>{{ $number }}</td>
                <td>{{ $detail['building'] }}</td>
                <td class="text-center">{{ $detail['floor'] }}</td>
                <td>{{ $detail['classification'] }}</td>
                <td>{{ $detail['description'] }}</td>
                <td>
                  <div data-kt-countup="true" data-kt-countup-value="{{ $detail['total'] }}<"
                    data-kt-countup-prefix="Rp. ">
                    0
                  </div>
                </td>
              </tr>
              @foreach ($detail['data'] as $work)
                <tr>
                  <td>{{ $number }}.{{ $loop->index + 1 }}</td>
                  <td colspan="4">
                    <div class="text-muted fw-bold">{{ $work['name'] }}</div>
                  </td>
                  <td>
                    <div class="text-muted fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $work['cost'] }}"
                      data-kt-countup-prefix="Rp. ">
                      0
                    </div>
                  </td>
                </tr>
              @endforeach
              @php
                $number++;
              @endphp
            @endforeach
          </tbody>
        </table>
      </div>
      <!--end::Table-->

    </div>
    <!--end::Card body-->

    <!--begin::Actions-->
    <div class="card-footer d-flex justify-content-end px-9 py-6">
      <a href="{{ route('repair.index') }}" type="reset"
        class="btn btn-white btn-active-light-primary me-2">{{ __('Kembali') }}</a>

      {{-- button approve reject --}}
      @if ($repairService->status == 'Ajukan' || $repairService->status == 'Sedang Direview')
        <button type="button" class="btn btn-danger me-2" id="rejectButton">
          @include('partials.general._button-indicator', ['label' => __('Tolak')])
        </button>
        @if ($repairService->status != 'Sedang Direview')
          <button type="button" class="btn btn-info me-2" id="reviewButton">
            @include('partials.general._button-indicator', ['label' => __('Sedang Direview')])
          </button>
        @endif
        <button type="button" class="btn btn-success" id="approveButton">
          @include('partials.general._button-indicator', ['label' => __('Setuju')])
        </button>
      @endif
    </div>
    <!--end::Actions-->
  </div>
  <!--end::Content-->
</div>
<!--end::Basic info-->
