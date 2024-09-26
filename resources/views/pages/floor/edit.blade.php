<x-base-layout>

  {{ theme()->getView('pages/floor/forms/_floor-edit', [
      'class' => 'mb-5 mb-xl-10',
      'floor' => $floor,
      'buildings' => $buildings,
  ]) }}

  {{-- Inject Scripts --}}
  @section('scripts')
    {{ theme()->getView('pages/floor/forms/_scripts-edit', [
        'floor' => $floor,
    ]) }}
  @endsection
</x-base-layout>
