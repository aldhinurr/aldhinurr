<x-base-layout>

  {{ theme()->getView('pages/reservation/forms/_reservation-details', [
      'class' => 'mb-5 mb-xl-10',
      'reservation' => $reservation,
      'extraFacilities' => $extraFacilities,
  ]) }}

  {{ theme()->getView('pages/reservation/forms/_modal-alihkan', [
      'reservation' => $reservation,
      'extraFacilities' => $extraFacilities,
  ]) }}


  @section('scripts')
    {{ theme()->getView('pages/reservation/forms/_scripts-details', [
        'reservation' => $reservation,
    ]) }}
    {{ theme()->getView('pages/reservation/forms/_scripts-alihkan', [
        'reservation' => $reservation,
    ]) }}
  @endsection

</x-base-layout>
