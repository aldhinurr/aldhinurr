<!--begin::Table-->
{{ $dataTable->table(['class' => 'table table-row-bordered gy-5']) }}
<!--end::Table-->

{{-- Inject Scripts --}}
@section('scripts')
  {{ $dataTable->scripts() }}
@endsection
