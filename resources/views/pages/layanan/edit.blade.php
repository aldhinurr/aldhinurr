<x-base-layout>

  {{ theme()->getView('pages/layanan/forms/_layanan-edit', [
      'class' => 'mb-5 mb-xl-10',
      'layanan' => $layanan,
      'gambars' => $layanan_gambars,
      'facilities' => $facilities,
  ]) }}

  {{-- Inject Scripts --}}
  @section('scripts')
    {{ theme()->getView('pages/layanan/forms/_scripts-edit', [
        'layanan' => $layanan,
        'gambars' => $layanan_gambars,
        'facilities' => $facilities,
    ]) }}
  @endsection
</x-base-layout>
