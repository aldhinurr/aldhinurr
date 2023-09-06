<x-base-layout>

  {{ theme()->getView('pages/repair/forms/_repair-details', [
      'class' => 'mb-5 mb-xl-10',
      'repairService' => $repairService,
      'repairServiceDetails' => $repairServiceDetails,
  ]) }}

  {{-- Inject Scripts --}}
  @section('scripts')
    {{ theme()->getView('pages/repair/forms/_scripts-details', ['repair' => $repairService]) }}
  @endsection

</x-base-layout>
