<x-base-layout>

  {{ theme()->getView('pages/reservation/forms/_reservation-details', [
      'class' => 'mb-5 mb-xl-10',
      'reservation' => $reservation,
      'extraFacilities' => $extraFacilities,
  ]) }}

  @section('scripts')
    {{ theme()->getView('pages/reservation/forms/_scripts-details', [
        'reservation' => $reservation,
    ]) }}
  @endsection

</x-base-layout>
