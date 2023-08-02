<x-base-layout>

  {{ theme()->getView('pages/report/forms/_report-details', [
      'class' => 'mb-5 mb-xl-10',
      'report' => $report,
      'imagesBefore' => $imagesBefore,
      'imagesAfter' => $imagesAfter,
  ]) }}

  @section('scripts')
    {{ theme()->getView('pages/report/forms/_scripts-details', [
        'report' => $report,
    ]) }}
  @endsection

</x-base-layout>
