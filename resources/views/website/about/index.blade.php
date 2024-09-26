@extends('layout.efacility.master')

@section('content')
@if(session('alert'))
    <div class="alert alert-danger text-center">
        <strong>{!! session('alert') !!}</strong>
    </div>
@endif

<div class="container my-5">
    <div class="text-center mb-5">
        <h4 class="display-4 font-weight-bold">Tentang E-Facility</h4>
        <br>
        <p class="lead">
                  E-Facility adalah sistem yang mengintegrasikan pelayanan fasilitas ITB, baik yang berbasis tarif (<i>rental based</i>) maupun non-tarif (<i>resource sharing based</i>), 
                  bagi sivitas akademika ITB. Dengan mengutamakan konsep pemanfaatan fasilitas secara kolektif, 
                  E-Facility memudahkan sivitas akademika ITB dalam mengakses, memesan, dan mengelola berbagai fasilitas kampus. 
                  Sistem ini dirancang untuk meningkatkan efektivitas dan kenyamanan dalam penggunaan sumber daya kampus, 
                  serta memastikan setiap anggota sivitas akademika ITB dapat memaksimalkan manfaat dari fasilitas yang tersedia.
        </p>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><strong>Asrama</strong></h5>
                    <p class="card-text">Akses informasi ketersediaan tempat tinggal bagi mahasiswa.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><strong>Sewa Layanan</strong></h5>
                    <p class="card-text">Menyediakan layanan sewa berbagai fasilitas kampus seperti ruang rapat, aula, dan peralatan lainnya, memastikan kebutuhan acara dan kegiatan dapat terpenuhi dengan optimal.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><strong>Resource Sharing</strong></h5>
                    <p class="card-text">Mendorong pemanfaatan bersama sumber daya kampus, memungkinkan pengguna untuk berbagi dan menggunakan fasilitas secara kolektif, sehingga meningkatkan efisiensi dan keberlanjutan.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><strong>Informasi Barang Tidak Digunakan</strong></h5>
                    <p class="card-text">Menyediakan informasi tentang barang-barang yang tidak lagi digunakan, memungkinkan redistribusi atau penggunaan ulang oleh anggota sivitas akademika yang membutuhkan.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title"><strong>Uji Laboratorium</strong></h5>
                    <p class="card-text">Memfasilitasi pemesanan dan pengelolaan jadwal penggunaan laboratorium untuk berbagai keperluan akademik dan penelitian, memastikan ketersediaan dan optimalisasi penggunaan laboratorium.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
