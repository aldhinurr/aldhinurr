<!--begin::Table-->
{{ $dataTable->table(['class' => 'table-form table-responsive']) }}
<!--end::Table-->

{{-- Inject Scripts --}}
@section('scripts')
  {{ $dataTable->scripts() }}
@endsection
