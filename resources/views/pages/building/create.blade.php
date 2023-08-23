<x-base-layout>

  {{ theme()->getView('pages/building/forms/_building-create', [
      'class' => 'mb-5 mb-xl-10',
  ]) }}

  {{-- Inject Scripts --}}
  @section('scripts')
    {{ theme()->getView('pages/building/forms/_scripts-create') }}
  @endsection
</x-base-layout>
