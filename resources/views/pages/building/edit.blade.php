<x-base-layout>

  {{ theme()->getView('pages/building/forms/_building-edit', [
      'class' => 'mb-5 mb-xl-10',
      'building' => $building,
  ]) }}

  {{-- Inject Scripts --}}
  @section('scripts')
    {{ theme()->getView('pages/building/forms/_scripts-edit', [
        'building' => $building,
    ]) }}
  @endsection
</x-base-layout>
