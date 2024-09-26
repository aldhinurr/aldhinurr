<x-base-layout>

  {{ theme()->getView('pages/barang/forms/_barang-edit', [
      'class' => 'mb-5 mb-xl-10',
      'barang' => $barang,
  ]) }}

  {{-- Inject Scripts --}}
  @section('scripts')
    {{ theme()->getView('pages/barang/forms/_scripts-edit', [
        'barang' => $barang,
    ]) }}
  @endsection
</x-base-layout>
