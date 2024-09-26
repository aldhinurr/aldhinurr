@extends('layout.efacility.master')

@section('content')
@if(session('alert'))
    <div class="alert alert-danger text-center">
        <strong>{!! session('alert') !!}</strong>
    </div>
@endif
  <!-- ================================
  START ROOMS AREA
  ================================= -->
  <section>
  <style>
        .card:hover .card-body {
            background-color: #287dfa; /* Ganti dengan warna biru yang diinginkan */
            color: white;
        }
        .card:hover .card-text a {
            color: white; /* Ubah warna teks menjadi putih saat di-hover */
        }
        .card-body {
            cursor: pointer; /* Menambahkan cursor pointer pada card body */
        }
    </style>
    <br><br>
    <div class="breadcrumb-wrap">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12">
            <div class="search-result-content">
              <div class="section-heading">
                <h2 class="sec__title text-dark">Uji Laboratorium</h2>
              </div>
              <div class="search-fields-container margin-top-30px">
                <div class="contact-form-action">
                    <div class="row">
                        <div class="col-lg-6 mb-2" style="margin-bottom: 2.5rem !important;">
                            <div class="card h-100" onclick="window.open('https://sipa.nrcn.itb.ac.id/listtools', '_blank')">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Layanan Pusat Penelitian</h5>
                                    <p class="card-text">https://sipa.nrcn.itb.ac.id/listtools</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-2" style="margin-bottom: 2.5rem !important;">
                            <div class="card h-100" onclick="window.open('https://ftmd.itb.ac.id/id/pelayanan-pengujian-laboratorium-ftmd-itb/', '_blank')">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Layanan Pengujian Laboratorium FTMD ITB</h5>
                                    <p class="card-text">https://ftmd.itb.ac.id/id/pelayanan-pengujian-laboratorium-ftmd-itb/</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-2" style="margin-bottom: 2.5rem !important;">
                            <div class="card h-100" onclick="window.open('https://fa.itb.ac.id/layanan-laboratorium-sekolah-farmasi-itb/', '_blank')">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Layanan Pengujian Laboratorium Sekolah Farmasi</h5>
                                    <p class="card-text">https://fa.itb.ac.id/layanan-laboratorium-sekolah-farmasi-itb/</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-2" style="margin-bottom: 2.5rem !important;">
                            <div class="card h-100" onclick="window.open('https://www.chem.itb.ac.id/layanan-pengukuran/', '_blank')">
                                <div class="card-body text-center">
                                    <h5 class="card-title">Layanan Pengujian Laboratorium Kimia</h5>
                                    <p class="card-text">https://www.chem.itb.ac.id/layanan-pengukuran/</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- end contact-form-action -->
              </div><!-- end search-fields-container -->
            </div><!-- end search-result-content -->
          </div><!-- end col-lg-12 -->
        </div><!-- end row -->
      </div><!-- end container -->
    </div><!-- end breadcrumb-wrap -->
    <br>
  </section><!-- end breadcrumb-area -->
@endsection
