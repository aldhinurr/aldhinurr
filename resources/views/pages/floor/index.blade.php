<x-base-layout>

  <!--begin::Card-->
  <div class="card">
    <!--begin::Card header-->
    <div class="card-header cursor-pointer">
      <!--begin::Card title-->
      <div class="card-title m-0">
        <h3 class="fw-bolder m-0"> {{ __('Gedung ') . $building->name }} </h3>
        <!--begin::Separator-->
        <span class="h-20px border-gray-200 border-start ms-3 mx-2"></span>
        <!--end::Separator-->

        <!--begin::Description-->
        <small class="text-muted fs-7 fw-bold my-1 ms-1">
          {{ __('Lantai & Ruang') }}
        </small>
        <!--end::Description-->
      </div>
      <!--end::Card title-->

      <!--begin::Action-->
      <div class="d-flex my-4">
        <a href="{{ route('floor.building') }}"
          class="btn btn-sm btn-white btn-active-light-primary align-self-center me-2">{{ __('Kembali') }}</a>
        <a href="{{ route('floor.create', $building->id) }}"
          class="btn btn-primary btn-sm align-self-center"><i class="bi bi-plus"></i>{{ __('Tambah Baru') }}</a>
      </div>
      <!--end::Action-->
    </div>
    <!--begin::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-6">
      @include('pages.floor._table')
    </div>
    <!--end::Card body-->
  </div>
  <!--end::Card-->

</x-base-layout>
