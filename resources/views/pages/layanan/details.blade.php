<x-base-layout>

    {{ theme()->getView('pages/layanan/forms/_layanan-details', [
        'class' => 'mb-5 mb-xl-10',
        'layanan' => $layanan,
        'gambars' => $layanan_gambars,
        'facilities' => $facilities,
    ]) }}

</x-base-layout>