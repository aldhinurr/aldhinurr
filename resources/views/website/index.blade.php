@extends('layout.efacility.master')

@section('content')
@if(session('alert'))
    <div class="alert alert-danger text-center">
        <strong>{!! session('alert') !!}</strong>
    </div>
@endif
  <!-- ================================
                                                                                                                                                                                                                                                                                                                                                                                                    START ABOUT AREA
                                                                                                                                                                                                                                                                                                                                                                                                ================================= -->
  <section class="about-area section--padding overflow-hidden">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="image-box about-img-box">
            <img src="{{ asset('efacility/images/img-facility.png') }}" alt="about-img" class="img__item img__item-1" />
          </div>
        </div>
        <!-- end col-lg-6 -->
        <div class="col-lg-6">
          <div class="about-content pr-5">
            <div class="section-heading">
              <h2 class="sec__title">E-Facility</h2>
              <p class="sec__desc pt-4">
                E-Facility Merupakan sistem untuk mengintegrasikan pelayanan penggunaan fasilitas ITB (resource sharing)
                berupa peminjaman fasilitas, penyewaan fasilitas, serta layanan uji laboratorium bagi pegawai ITB (Dosen
                dan Tendik).
              </p>
              <p class="sec__desc pt-4">Fasilitas meliputi (dapat menyesuaikan kebutuhan) :</p>
              <p class="sec__desc">- Sewa ruang untuk kegiatan seminar dan konferensi.</p>
              <p class="sec__desc">- Sewa kendaraan untuk kebutuhan perjalan dinas.</p>
              <p class="sec__desc">- Laporan untuk kerusakan, kebersihan, dan keamanan.</p>
            </div>
            <!-- end section-heading -->
          </div>
        </div>
        <!-- end col-lg-6 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </section>
  <!-- ================================
                                                                                                                                                                                                                                                                                                                                                                                                    END ABOUT AREA
                                                                                                                                                                                                                                                                                                                                                                                                ================================= -->

  <!-- ================================
                                                                                                                                                                                                                                                                                                                                                                                                START GALLERY AREA
                                                                                                                                                                                                                                                                                                                                                                                            ================================= -->
  <section class="gallery-area section-padding  padding-top-10px">
    <div class="container">
      <div class="full-width-slider carousel-action">
        <div class="full-width-slide-item">
          <a class="d-block" data-fancybox="gallery" href="{{ asset('efacility/images/image-slider-1.jfif') }}"
            data-caption="Showing image 1">
            <img src="{{ asset('efacility/images/image-slider-1.jfif') }}">
          </a>
        </div><!-- end full-width-slide-item -->
        <div class="full-width-slide-item">
          <a class="d-block" data-fancybox="gallery" href="{{ asset('efacility/images/image-slider-2.jfif') }}"
            data-caption="Showing image 2">
            <img src="{{ asset('efacility/images/image-slider-2.jfif') }}">
          </a>
        </div><!-- end full-width-slide-item -->
        <div class="full-width-slide-item">
          <a class="d-block" data-fancybox="gallery" href="{{ asset('efacility/images/image-slider-3.jfif') }}"
            data-caption="Showing image 3">
            <img src="{{ asset('efacility/images/image-slider-3.jfif') }}">
          </a>
        </div><!-- end full-width-slide-item -->
      </div><!-- end full-width-slider -->
    </div>
  </section><!-- end gallery-area -->
  <!-- ================================
                                                                                                                                                                                                                                                                                                                                                                                                END GALLERY AREA
                                                                                                                                                                                                                                                                                                                                                                                            ================================= -->

  <!-- ================================
                                                                                                                                                                                                                                                                                                                                                                                                START INFO AREA
                                                                                                                                                                                                                                                                                                                                                                                            ================================= -->
  <section class="info-area padding-bottom-20px">
    <div class="container">
      <div class="row padding-top-50px justify-content-md-center">
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-4 d-flex-center">
            <div class="info-icon flex-shrink-0">
              <i class="la la-building"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content text-center">
              <h4 class="info__title" style="font-size: 45px;">{{ $count_rooms }}</h4>
              <h3 class="info__title">Ruang</h3>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-4 -->
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-4 d-flex-center">
            <div class="info-icon flex-shrink-0">
              <i class="la la-shuttle-van"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content text-center">
              <h4 class="info__title" style="font-size: 45px;">{{ $count_cars }}</h4>
              <h3 class="info__title">Kendaraan</h3>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-4 -->
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-4 d-flex-center">
            <div class="info-icon flex-shrink-0">
              <i class="la la-map-signs"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content text-center">
              <h4 class="info__title" style="font-size: 45px;">{{ $count_selasar }}</h4>
              <h3 class="info__title">Selasar</h3>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-4 -->
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-4 d-flex-center">
            <div class="info-icon flex-shrink-0">
              <i class="la la-road"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content text-center">
              <h4 class="info__title" style="font-size: 45px;">{{ $count_lapangan }}</h4>
              <h3 class="info__title">Lapangan</h3>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-4 -->
        {{-- <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-4 d-flex-center">
            <div class="info-icon flex-shrink-0">
              <i class="la la-file-text"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content text-center">
              <h4 class="info__title" style="font-size: 45px;">{{ $report_done }}</h4>
              <h3 class="info__title">Laporan Tertangani</h3>
              </p>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div> --}}
        <!-- end col-lg-4 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </section>
  <!-- end info-area -->
  <!-- ================================
                                                                                                                                                                                                                                                                                                                                                                                                END INFO AREA
                                                                                                                                                                                                                                                                                                                                                                                            ================================= -->

  <div class="section-block"></div>

  <!-- ================================
                                                                                                                                                                                                                                                                                                                                                                                                START INFO AREA
                                                                                                                                                                                                                                                                                                                                                                                            ================================= -->
  <section class="info-area padding-top-30px padding-bottom-70px">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-8">
          <div class="section-heading">
            <h2 class="sec__title">Lokasi</h2>
          </div>
          <!-- end section-heading -->
        </div>
        <!-- end col-lg-8 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-50px">
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-3 d-flex">
            <div class="info-icon flex-shrink-0">
              <i class="la la-university"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content mt-4">
              <h3 class="sec__title">ITB Kampus Ganesha</h3>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-3 -->
        {{--<div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-3 d-flex">
            <div class="info-icon flex-shrink-0">
              <i class="la la-university"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content mt-4">
              <h3 class="sec__title">ITB Kampus Jatinangor</h3>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-3 -->
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-3 d-flex">
            <div class="info-icon flex-shrink-0">
              <i class="la la-university"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content mt-4">
              <h3 class="sec__title">ITB Kampus Cirebon</h3>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-3 -->
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-3 d-flex">
            <div class="info-icon flex-shrink-0">
              <i class="la la-university"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content mt-4">
              <h3 class="sec__title">ITB Kampus Jakarta</h3>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-3 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-30px justify-content-md-center">
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-3 d-flex">
            <div class="info-icon flex-shrink-0">
              <i class="la la-university"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content mt-4">
              <h3 class="sec__title">Bosscha</h3>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>--}}
        <!-- end col-lg-3 -->
        <!-- <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-3 d-flex">
            <div class="info-icon flex-shrink-0">
              <i class="la la-university"></i>
            </div> -->
            <!-- end info-icon-->
            <!-- <div class="info-content mt-4">
              <h3 class="sec__title">Saraga</h3>
            </div> -->
            <!-- end info-content -->
          <!-- </div> -->
          <!-- end icon-box -->
        <!-- </div> -->
        <!-- end col-lg-3 -->
      </div>
      <!-- end row -->
    </div>
    <!-- end container -->
  </section>
  <!-- end info-area -->
  <!-- ================================
  END INFO AREA
  ================================= -->


  <!-- ================================
  START ROOMS AREA
  ================================= -->
  <section class="hotel-area section-bg padding-top-40px padding-bottom-30px overflow-hidden">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2 class="sec__title line-height-55">
              Ruangan
            </h2>
          </div>
          <!-- end section-heading -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-20px">
        <div class="col-lg-12">
          <div class="hotel-card-wrap">
            <div class="hotel-card-carousel-2 carousel-action">
              @foreach ($rooms as $room)
                <div class="card-item">
                  <div class="card-img-top overflow-hidden" style="height: 247px; width: auto;">
                    <a href="{{ route('website.room.show', $room->id) }}" class="d-block">
                      @if ($room->layanan_gambars->first())
                        <img src="{{ asset($room->layanan_gambars[0]['picture']) }}" alt="hotel-img" />
                      @else
                        <img src="https://source.unsplash.com/600x400?building" alt="hotel-img" />
                      @endif
                    </a>
                  </div>
                  <div class="card-body">
                    <h3 class="card-title">
                      <a href="{{ route('website.room.show', $room->id) }}">{{ $room->name }}</a>
                    </h3>
                    <div class="card-attributes">
                      <ul class="d-flex align-items-center">
                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                          title="Kapasitas">
                          <i class="la la-users"></i><span>{{ $room->capacity }} Orang</span>
                        </li>
                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                          title="Luas">
                          <i class="la la-expand"></i><span>{{ $room->large }} m<sup>2</sup></span>
                        </li>
                      </ul>
                    </div>
                    <p class="card-meta">{{ $room->address }}</p>
                    <div class="card-price d-flex align-items-center justify-content-between">
                      <p>
                        <span class="price__num">
                          @if ($room->price == 0)
                            Gratis
                          @else
                            Rp. {{ number_format($room->price, 0) }}
                          @endif
                        </span>
                        <span class="price__text">Per {{ $room->price_for }}</span>
                      </p>
                      @if ($room->is_sewa == 1)
                        <span class="price__text">Sedang Disewa</span>
                      @else
                        <a href="{{ route('website.room.show', $room->id) }}" class="btn-text">
                          Lihat<i class="la la-angle-right"></i>
                        </a>
                      @endif
                    </div>
                  </div>
                </div>
                <!-- end card-item -->
              @endforeach
            </div>
            <!-- end hotel-card-carousel -->
          </div>
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="btn-box pt-3 text-center">
        <a href="{{ route('website.rooms') }}" class="theme-btn">Lihat Ruangan Lainnya <i
            class="la la-arrow-right ml-1"></i></a>
      </div>
    </div>
    <!-- end container-fluid -->
  </section>
  <!-- end rooms-area -->
  <!-- ================================
  END RROMS AREA
  ================================= -->


  <!-- ================================ 
  START CAR AREA 
  ================================= -->
  <section class="car-area section-padding padding-top-40px padding-bottom-30px overflow-hidden">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2 class="sec__title">Kendaraan</h2>
          </div>
          <!-- end section-heading -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-20px">
        <div class="col-lg-12">
          <div class="car-carousel carousel-action">
            @foreach ($cars as $car)
              <div class="card-item car-card mb-0 border">
                <div class="card-img-top overflow-hidden" style="height: 247px; width: auto;">
                  <a href="{{ route('website.car.show', $car->id) }}" class="d-block">
                    @if ($car->layanan_gambars->first())
                      <img src="{{ asset($car->layanan_gambars[0]['picture']) }}" alt="kendaraan-img" />
                    @else
                      <img src="https://source.unsplash.com/600x400?car" alt="kendaraan-img" />
                    @endif
                  </a>
                </div>
                <div class="card-body">
                  <!-- <p class="card-meta">Compact SUV</p> -->
                  <h3 class="card-title">
                    <a href="{{ route('website.car.show', $car->id) }}">{{ $car->name }}</a>
                  </h3>
                  <div class="card-attributes">
                    <ul class="d-flex align-items-center">
                      <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                        title="Kapasitas">
                        <i class="la la-users"></i><span>{{ $car->capacity }} Orang</span>
                      </li>
                    </ul>
                  </div>
                  <p class="card-meta">{{ $car->address }}</p>
                  <div class="card-price d-flex align-items-center justify-content-between">
                    <p>
                      <span class="price__num">
                        @if ($car->price == 0)
                          Gratis
                        @else
                          Rp. {{ number_format($car->price, 0) }}
                        @endif
                      </span>
                      <span class="price__text">Per {{ $car->price_for }}</span>
                    </p>
                    @if ($car->is_sewa == 1)
                      <span class="price__text">Sedang Disewa</span>
                    @else
                      <a href="{{ route('website.car.show', $car->id) }}" class="btn-text">
                        Lihat<i class="la la-angle-right"></i>
                      </a>
                    @endif
                  </div>
                </div>
              </div>
              <!-- end card-item -->
            @endforeach
          </div>
          <!-- end car-carousel -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="btn-box pt-3 text-center">
        <a href="{{ route('website.cars') }}" class="theme-btn">Lihat Kendaraan Lainnya <i
            class="la la-arrow-right ml-1"></i></a>
      </div>
    </div>
    <!-- end container -->
  </section> 
  <!-- end car-area -->
<!-- ================================
END CAR AREA
================================= -->


<div class="section-block"></div>


<!-- ================================
START SELASAR AREA
================================= -->
<section class="hotel-area section-bg padding-top-40px padding-bottom-30px overflow-hidden">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2 class="sec__title line-height-55">
              Selasar
            </h2>
          </div>
          <!-- end section-heading -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-20px">
        <div class="col-lg-12">
          <div class="hotel-card-wrap">
            <div class="hotel-card-carousel-2 carousel-action">
              @foreach ($selasar as $selasar)
                <div class="card-item">
                  <div class="card-img-top overflow-hidden" style="height: 247px; width: auto;">
                    <a href="{{ route('website.selasar.show', $selasar->id) }}" class="d-block">
                      @if ($selasar->layanan_gambars->first())
                        <img src="{{ asset($selasar->layanan_gambars[0]['picture']) }}" alt="hotel-img" />
                      @else
                        <img src="https://source.unsplash.com/600x400?lobby" alt="hotel-img" />
                      @endif
                    </a>
                  </div>
                  <div class="card-body">
                    <h3 class="card-title">
                      <a href="{{ route('website.selasar.show', $selasar->id) }}">{{ $selasar->name }}</a>
                    </h3>
                    <div class="card-attributes">
                      <ul class="d-flex align-items-center">
                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                          title="Kapasitas">
                          <i class="la la-users"></i><span>{{ $selasar->capacity }} Orang</span>
                        </li>
                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                          title="Luas">
                          <i class="la la-expand"></i><span>{{ $selasar->large }} m<sup>2</sup></span>
                        </li>
                      </ul>
                    </div>
                    <p class="card-meta">{{ $selasar->address }}</p>
                    <div class="card-price d-flex align-items-center justify-content-between">
                      <p>
                        <span class="price__num">
                          @if ($selasar->price == 0)
                            Gratis
                          @else
                            Rp. {{ number_format($room->price, 0) }}
                          @endif
                        </span>
                        <span class="price__text">Per {{ $selasar->price_for }}</span>
                      </p>
                      @if ($selasar->is_sewa == 1)
                        <span class="price__text">Sedang Disewa</span>
                      @else
                        <a href="{{ route('website.selasar.show', $selasar->id) }}" class="btn-text">
                          Lihat<i class="la la-angle-right"></i>
                        </a>
                      @endif
                    </div>
                  </div>
                </div>
                <!-- end card-item -->
              @endforeach
            </div>
            <!-- end hotel-card-carousel -->
          </div>
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="btn-box pt-3 text-center">
        <a href="{{ route('website.selasar') }}" class="theme-btn">Lihat Selasar Lainnya <i
            class="la la-arrow-right ml-1"></i></a>
      </div>
    </div>
    <!-- end container-fluid -->
  </section>
<!-- ================================
END SELASAR AREA
================================= -->


<div class="section-block"></div>


<!-- ================================
START LAPANGAN AREA
================================= -->
  <section class="car-area section-padding padding-top-40px padding-bottom-30px overflow-hidden">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2 class="sec__title">Lapangan</h2>
          </div>
          <!-- end section-heading -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-20px">
        <div class="col-lg-12">
          <div class="car-carousel carousel-action">
            @foreach ($lapangan as $lapangan)
              <div class="card-item car-card mb-0 border">
                <div class="card-img-top overflow-hidden" style="height: 247px; width: auto;">
                  <a href="{{ route('website.lapangan.show', $lapangan->id) }}" class="d-block">
                    @if ($lapangan->layanan_gambars->first())
                      <img src="{{ asset($lapangan->layanan_gambars[0]['picture']) }}" alt="lapangan-img" />
                    @else
                      <img src="https://source.unsplash.com/600x400?football" alt="lapangan-img" />
                    @endif
                  </a>
                </div>
                <div class="card-body">
                  <h3 class="card-title">
                    <a href="{{ route('website.lapangan.show', $lapangan->id) }}">{{ $lapangan->name }}</a>
                  </h3>
                  <div class="card-attributes">
                    <ul class="d-flex align-items-center">
                      <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                        title="Kapasitas">
                        <i class="la la-users"></i><span>{{ $lapangan->capacity }} Orang</span>
                      </li>
                    </ul>
                  </div>
                  <p class="card-meta">{{ $lapangan->address }}</p>
                  <div class="card-price d-flex align-items-center justify-content-between">
                    <p>
                      <span class="price__num">
                        @if ($lapangan->price == 0)
                          Gratis
                        @else
                          Rp. {{ number_format($lapangan->price, 0) }}
                        @endif
                      </span>
                      <span class="price__text">Per {{ $lapangan->price_for }}</span>
                    </p>
                    @if ($lapangan->is_sewa == 1)
                      <span class="price__text">Sedang Disewa</span>
                    @else
                      <a href="{{ route('website.lapangan.show', $lapangan->id) }}" class="btn-text">
                        Lihat<i class="la la-angle-right"></i>
                      </a>
                    @endif
                  </div>
                </div>
              </div>
              <!-- end card-item -->
            @endforeach
          </div>
          <!-- end lapangan-carousel -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="btn-box pt-3 text-center">
        <a href="{{ route('website.lapangan') }}" class="theme-btn">Lihat Lapangan Lainnya <i
            class="la la-arrow-right ml-1"></i></a>
      </div>
    </div>
    <!-- end container -->
  </section>
  <!-- end lapangan-area -->
<!-- ================================
END LAPANGAN AREA
================================= -->


<div class="section-block"></div>


<!-- ================================
START LAPORAN AREA
================================= -->
  <section class="info-area padding-top-70px padding-bottom-70px" hidden>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-8">
          <div class="section-heading">
            <h2 class="sec__title">Laporan</h2>
          </div>
          <!-- end section-heading -->
        </div>
        <!-- end col-lg-8 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-30px justify-content-md-center">
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-3 d-flex">
            <div class="info-icon flex-shrink-0">
              <i class="la la-bullhorn"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content mt-2">
              <h2 class="sec__title text-dark">{{ $report_waiting }}</h2>
              <h6 class="info__title">Kerusakan</h6>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-3 -->
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-3 d-flex">
            <div class="info-icon flex-shrink-0">
              <i class="la la-recycle"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content mt-2">
              <h2 class="sec__title text-dark">{{ $report_process }}</h2>
              <h6 class="info__title">Proses</h6>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-3 -->
        <div class="col-lg-3 responsive-column">
          <div class="icon-box icon-layout-3 d-flex">
            <div class="info-icon flex-shrink-0">
              <i class="la la-file-text"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content mt-2">
              <h2 class="sec__title text-dark">{{ $report_done }}</h2>
              <h6 class="info__title">Tertangani</h6>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-3 -->
      </div>
      <!-- end row -->
      <div class="btn-box pt-4 text-center">
        <a href="{{ route('website.status') }}#my-laporan" class="theme-btn">Lihat Laporan <i
            class="la la-arrow-right ml-1"></i></a>
      </div>
    </div>
    <!-- end container -->
  </section>
  <!-- end info-area -->
  <!-- ================================
  END INFO AREA
  ================================= -->
@endsection
