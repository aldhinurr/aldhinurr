<x-base-layout>

    {{ theme()->getView('pages/facility/forms/_facility-details', [
        'class' => 'mb-5 mb-xl-10',
        'facility' => $facility
    ]) }}

</x-base-layout>