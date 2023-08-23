<x-base-layout>

  {{ theme()->getView('pages/floor/forms/_floor-create', [
      'class' => 'mb-5 mb-xl-10',
      'building' => $building,
  ]) }}

  {{-- Inject Scripts --}}
  @section('scripts')
    {{ theme()->getView('pages/floor/forms/_scripts-create', ['building' => $building]) }}
  @endsection
</x-base-layout>
