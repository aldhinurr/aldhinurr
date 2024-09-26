<x-base-layout>

  {{ theme()->getView('pages/barang/forms/_barang-create', [
      'class' => 'mb-5 mb-xl-10',
  ]) }}

  {{-- Inject Scripts --}}
  @section('scripts')
    {{ theme()->getView('pages/barang/forms/_scripts-create') }}
  @endsection
</x-base-layout>
