@extends('layout.efacility.master')

@section('content')
  <!-- ================================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            START CART AREA
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ================================= -->
  <section class="cart-area section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="listing-header pb-4">
            <h3 class="title font-size-28 pb-2">Status Layanan</h3>
          </div>
          <div class="cart-wrap">
            <div class="table-form table-responsive mb-3">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Laporan Kerusakan</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">
                      <div class="table-content product-content d-flex align-items-center">
                        <div class="product-content">
                          <a href="#" class="title">Tanggal
                            {{ date('d-m-Y H:i', strtotime($reportService->created_at)) }}</a>
                          <div class="product-info-wrap">
                            <div class="product-info line-height-24">
                              <div class="product-info-value">
                                {{ $reportService->keterangan }}
                              </div>
                            </div><!-- end product-info -->
                          </div>
                        </div>
                      </div>
                    </th>
                    <td>
                      <span class="title text-center">{{ $reportService->status }}</span>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row" colspan="2">
                      <div class="container">
                        <a href="#" class="title">Gambar Sebelum</a>
                        <div class="row padding-top-30px">
                          @foreach ($reportServiceImagesBefore as $imgBefore)
                            <div class="col-lg-3">
                              <div class="gallery-card">
                                <a class="d-block" data-fancybox="gallery" href="{{ asset($imgBefore->image) }}"
                                  data-caption="Showing image">
                                  <img src="{{ asset($imgBefore->image) }}">
                                </a>
                              </div><!-- end card-item -->
                            </div><!-- end col-lg-4 -->
                          @endforeach
                        </div><!-- end row -->
                      </div>
                    </th>
                  </tr>
                  <tr>
                    <th scope="row" colspan="2">
                      <div class="container">
                        <a href="#" class="title">Gambar Sesudah</a>
                        <div class="row padding-top-30px">
                          @if (count($reportServiceImagesAfter) > 0)
                            @foreach ($reportServiceImagesAfter as $imgAfter)
                              <div class="col-lg-3">
                                <div class="gallery-card">
                                  <a class="d-block" data-fancybox="gallery" href="{{ asset($imgAfter->image) }}"
                                    data-caption="Showing image">
                                    <img src="{{ asset($imgAfter->image) }}">
                                  </a>
                                </div><!-- end card-item -->
                              </div><!-- end col-lg-4 -->
                            @endforeach
                          @else
                            <div class="col-lg-3 text-muted">Belum Tersedia.</div>
                          @endif
                        </div><!-- end row -->
                      </div>
                    </th>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="section-block"></div>
          </div><!-- end cart-wrap -->
        </div><!-- end col-lg-12 -->
      </div><!-- end row -->
    </div><!-- end container -->
  </section><!-- end cart-area -->
  <!-- ================================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                            END CART AREA
                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ================================= -->
@endsection
