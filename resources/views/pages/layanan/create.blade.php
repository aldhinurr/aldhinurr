<x-base-layout>

  {{ theme()->getView('pages/layanan/forms/_layanan-create', [
      'class' => 'mb-5 mb-xl-10',
  ]) }}

  {{-- Inject Scripts --}}
  @section('scripts')
    {{ theme()->getView('pages/layanan/forms/_scripts-create') }}
  @endsection
</x-base-layout>
