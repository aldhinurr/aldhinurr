<x-base-layout>

  {{ theme()->getView('pages/facility/forms/_facility-edit', [
      'class' => 'mb-5 mb-xl-10',
      'facility' => $facility,
      'icons' => $icons,
  ]) }}

  {{-- Inject Scripts --}}
  @section('scripts')
  {{ theme()->getView('pages/facility/forms/_scripts-edit', [
        'facility' => $facility,
    ]) }}
  @endsection
</x-base-layout>