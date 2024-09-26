<x-base-layout>

  <!--begin::Card-->
  <div class="card">
    <!--begin::Card header-->
    <div class="card-header cursor-pointer">
      <!--begin::Card title-->
      <div class="card-title m-0">
        <h3 class="fw-bolder m-0"> {{ __('Lantai & Gedung')}} </h3>
        <!--begin::Separator-->
        <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
        <!--end::Separator-->
        <!--begin::Description-->
        <small class="text-muted fs-7 fw-bold my-1 ms-1">
          {{ __('Unit Pengelola: ') . auth()->user()->itb_unit }}
        </small>
        <!--end::Description-->
      </div>
      <div class="d-flex my-4">
        <a href="{{ route('data.luas') }}" class="btn btn-success btn-sm align-self-center">
        <i class="bi bi-filetype-xls"></i> {{ __('Unduh Data Luas') }}</a> &nbsp;&nbsp;
          <a href="{{ route('floor.create') }}" 
            class="btn btn-primary btn-sm align-self-center"><i class="bi bi-plus"></i> {{ __('Tambah Baru') }}
          </a>
        </div>
      <!--end::Card title-->
    </div>
    <!--begin::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-6">
      @include('pages.floor._table-building')
    </div>
    <!--end::Card body-->
  </div>
  <!--end::Card-->

</x-base-layout>
