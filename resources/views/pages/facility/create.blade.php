<x-base-layout>

  {{ theme()->getView('pages/facility/forms/_facility-create', [
      'class' => 'mb-5 mb-xl-10', 'icons' => $icons
  ]) }}

  {{-- Inject Scripts --}}
  @section('scripts')
  {{ theme()->getView('pages/facility/forms/_scripts-create') }}
  @endsection
</x-base-layout>