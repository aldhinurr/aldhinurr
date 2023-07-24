<x-base-layout>

  <!--begin::Card-->
  <div class="card">
    <!--begin::Card header-->
    <div class="card-header cursor-pointer">
      <!--begin::Card title-->
      <div class="card-title m-0">
        <h3 class="fw-bolder m-0"> Data {{ theme()->getOption('page', 'title') }}</h3>
      </div>
      <!--end::Card title-->
    </div>
    <!--begin::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-6">
      @include('pages.reservation._table')
    </div>
    <!--end::Card body-->
  </div>
  <!--end::Card-->

</x-base-layout>