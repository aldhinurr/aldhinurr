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
  <section class="hotel-area section-bg padding-top-20px padding-bottom-30px overflow-hidden">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2 class="sec__title line-height-55" style="font-size: 25px;">
              Ruangan
            </h2>
          </div>
          <!-- end section-heading -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-10px">
        <div class="col-lg-12">
          <div class="hotel-card-wrap">
            <div class="hotel-card-carousel-2 carousel-action">
              @foreach ($rooms as $room)
                <div class="card-item">
                  <div class="card-img-top overflow-hidden" style="width: 100%; height: 250px;">
                      <a href="{{ route('website.room.show', $room->id) }}" id="link-detail" class="d-block" style="display: block; width: 100%; height: 100%;">
                          @if ($room->layanan_gambars->first())
                              <div style="width: 100%; height: 100%; background-image: url('{{ asset($room->layanan_gambars[0]['picture']) }}'); background-size: cover; background-position: center;"></div>
                          @else
                              <div style="width: 100%; height: 100%; background-image: url('https://source.unsplash.com/600x400?rooms'); background-size: cover; background-position: center;"></div>
                          @endif
                      </a>
                  </div>
                  <div class="card-body">
                    <h3 class="card-title">
                      <a href="{{ route('website.room.show', $room->id) }}">{{ $room->name }}</a>
                    </h3>
                    <small> Unit: {{ $room->unit_pengelola }}</small>
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
                            <!--Gratis-->
                          @else
                            Rp. {{ number_format($room->price, 0) }}
                          @endif
                        </span>
                        @if ($room->price != 0)
                        <span class="price__text">Per {{ $room->price_for }}</span>
                        @endif
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
START RKU AREA
================================= -->
<section class="hotel-area section-padding padding-top-20px padding-bottom-30px overflow-hidden">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
          <h2 class="sec__title line-height-55" style="font-size: 25px;">
              Ruang Kuliah Umum
            </h2>
          </div>
          <!-- end section-heading -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-10px">
        <div class="col-lg-12">
          <div class="hotel-card-wrap">
            <div class="hotel-card-carousel-2 carousel-action">
              @foreach ($rku as $rku)
                <div class="card-item">
                  <div class="card-img-top overflow-hidden" style="height: 250px; width: auto;">
                      <a href="{{ route('website.rku.show', $rku->id) }}" id="link-detail" class="d-block" style="display: block; width: 100%; height: 100%;">
                          @if ($rku->layanan_gambars->first())
                              <div style="width: 100%; height: 100%; background-image: url('{{ asset($rku->layanan_gambars[0]['picture']) }}'); background-size: cover; background-position: center;"></div>
                          @else
                              <div style="width: 100%; height: 100%; background-image: url('https://source.unsplash.com/600x400?rooms'); background-size: cover; background-position: center;"></div>
                          @endif
                      </a>
                  </div>
                  <div class="card-body">
                    <h3 class="card-title">
                      <a href="{{ route('website.rku.show', $rku->id) }}">{{ $rku->name }}</a>
                    </h3>
                    <small> Unit: {{ $rku->unit_pengelola }}</small>
                    <div class="card-attributes">
                      <ul class="d-flex align-items-center">
                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                          title="Kapasitas">
                          <i class="la la-users"></i><span>{{ $rku->capacity }} Orang</span>
                        </li>
                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                          title="Luas">
                          <i class="la la-expand"></i><span>{{ $rku->large }} m<sup>2</sup></span>
                        </li>
                      </ul>
                    </div>
                    <p class="card-meta">{{ $rku->address }}</p>
                    <div class="card-price d-flex align-items-center justify-content-between">
                      <p>
                        <span class="price__num">
                          @if ($rku->price == 0)
                            <!--Gratis-->
                          @else
                            Rp. {{ number_format($rku->price, 0) }}
                          @endif
                        </span>
                        @if ($rku->price != 0)
                        <span class="price__text">Per {{ $rku->price_for }}</span>
                        @endif
                      </p>
                      @if ($rku->is_sewa == 1)
                        <span class="price__text">Sedang Disewa</span>
                      @else
                        <a href="{{ route('website.rku.show', $rku->id) }}" class="btn-text">
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
        <a href="{{ route('website.rku') }}" class="theme-btn">Lihat Ruang Kuliah Umum Lainnya <i
            class="la la-arrow-right ml-1"></i></a>
      </div>
    </div>
    <!-- end container-fluid -->
  </section>
<!-- ================================
END RKU AREA
================================= -->

<!-- <div class="section-block"></div> -->

<!-- ================================
START RUMAH SUSUN AREA
================================= -->
<section class="hotel-area section-bg padding-top-20px padding-bottom-30px overflow-hidden">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
          <h2 class="sec__title line-height-55" style="font-size: 25px;">
              Rumah Susun / Transit
            </h2>
          </div>
          <!-- end section-heading -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-10px">
        <div class="col-lg-12">
          <div class="hotel-card-wrap">
            <div class="hotel-card-carousel-2 carousel-action">
              @foreach ($rumah as $rumah)
                <div class="card-item">
                  <div class="card-img-top overflow-hidden" style="height: 250px; width: auto;">
                      <a href="{{ route('website.rumah.show', $rumah->id) }}" id="link-detail" class="d-block" style="display: block; width: 100%; height: 100%;">
                          @if ($rumah->layanan_gambars->first())
                              <div style="width: 100%; height: 100%; background-image: url('{{ asset($rumah->layanan_gambars[0]['picture']) }}'); background-size: cover; background-position: center;"></div>
                          @else
                              <div style="width: 100%; height: 100%; background-image: url('https://source.unsplash.com/600x400?rooms'); background-size: cover; background-position: center;"></div>
                          @endif
                      </a>
                  </div>
                  <div class="card-body">
                    <h3 class="card-title">
                      <a href="{{ route('website.rumah.show', $rumah->id) }}">{{ $rumah->name }}</a>
                    </h3>
                    <small> Unit: {{ $rumah->unit_pengelola }}</small>
                    <div class="card-attributes">
                      <ul class="d-flex align-items-center">
                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                          title="Kapasitas">
                          <i class="la la-users"></i><span>{{ $rumah->capacity }} Orang</span>
                        </li>
                        <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                          title="Luas">
                          <i class="la la-expand"></i><span>{{ $rumah->large }} m<sup>2</sup></span>
                        </li>
                      </ul>
                    </div>
                    <p class="card-meta">{{ $rumah->address }}</p>
                    <div class="card-price d-flex align-items-center justify-content-between">
                      <p>
                        <span class="price__num">
                          @if ($rumah->price == 0)
                            <!--Gratis-->
                          @else
                            Rp. {{ number_format($rumah->price, 0) }}
                          @endif
                        </span>
                        @if ($rumah->price != 0)
                        <span class="price__text">Per {{ $rumah->price_for }}</span>
                        @endif
                      </p>
                      @if ($rumah->is_sewa == 1)
                        <span class="price__text">Sedang Disewa</span>
                      @else
                        <a href="{{ route('website.rumah.show', $rumah->id) }}" class="btn-text">
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
        <a href="{{ route('website.rumah') }}" class="theme-btn">Lihat Rumah Susun / Transit Lainnya <i
            class="la la-arrow-right ml-1"></i></a>
      </div>
    </div>
    <!-- end container-fluid -->
  </section>
<!-- ================================
END RUMAH SUSUN AREA
================================= -->

  <!-- ================================ 
  START CAR AREA 
  ================================= -->
 <section class="hotel-area section-padding padding-top-20px padding-bottom-30px overflow-hidden">
  <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
          <h2 class="sec__title line-height-55" style="font-size: 25px;">
            Kendaraan
          </h2>
          </div>
        </div>
      </div>
      <div class="row padding-top-10px">
        <div class="col-lg-12">
          <div class="car-carousel carousel-action">
            @foreach ($cars as $car)
              <div class="card-item car-card mb-0 border">
                <div class="card-img-top overflow-hidden" style="height: 250px; width: auto;">
                    <a href="{{ route('website.car.show', $car->id) }}" id="link-detail" class="d-block" style="display: block; width: 100%; height: 100%;">
                        @if ($car->layanan_gambars->first())
                            <div style="width: 100%; height: 100%; background-image: url('{{ asset($car->layanan_gambars[0]['picture']) }}'); background-size: cover; background-position: center;"></div>
                        @else
                            <div style="width: 100%; height: 100%; background-image: url('https://source.unsplash.com/600x400?cars'); background-size: cover; background-position: center;"></div>
                        @endif
                    </a>
                </div>
                <div class="card-body">
                  <h3 class="card-title">
                    <a href="{{ route('website.car.show', $car->id) }}">{{ $car->name }}</a>
                  </h3>
                  <small> Unit: {{ $car->unit_pengelola }}</small>
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
                          <!--Gratis-->
                        @else
                          Rp. {{ number_format($car->price, 0) }}
                        @endif
                      </span>
                      @if ($car->price != 0)
                      <span class="price__text">Per {{ $car->price_for }}</span>
                      @endif
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
            @endforeach
          </div>
        </div>
      </div>
      <div class="btn-box pt-3 text-center">
        <a href="{{ route('website.cars') }}" class="theme-btn">Lihat Kendaraan Lainnya <i
            class="la la-arrow-right ml-1"></i></a>
      </div>
    </div>
  </section> 
<!-- end car-area -->
<!-- ================================
END CAR AREA
================================= -->

<!-- ================================
START SELASAR AREA
================================= -->
<section class="hotel-area section-bg padding-top-20px padding-bottom-30px overflow-hidden">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
          <h2 class="sec__title line-height-55" style="font-size: 25px;">
              Selasar
            </h2>
          </div>
          <!-- end section-heading -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-10px">
        <div class="col-lg-12">
          <div class="hotel-card-wrap">
            <div class="hotel-card-carousel-2 carousel-action">
              @foreach ($selasar as $selasar)
                <div class="card-item">
                  <div class="card-img-top overflow-hidden" style="height: 250px; width: auto;">
                      <a href="{{ route('website.selasar.show', $selasar->id) }}" id="link-detail" class="d-block" style="display: block; width: 100%; height: 100%;">
                          @if ($selasar->layanan_gambars->first())
                              <div style="width: 100%; height: 100%; background-image: url('{{ asset($selasar->layanan_gambars[0]['picture']) }}'); background-size: cover; background-position: center;"></div>
                          @else
                              <div style="width: 100%; height: 100%; background-image: url('https://source.unsplash.com/600x400?rooms'); background-size: cover; background-position: center;"></div>
                          @endif
                      </a>
                  </div>
                  <div class="card-body">
                    <h3 class="card-title">
                      <a href="{{ route('website.selasar.show', $selasar->id) }}">{{ $selasar->name }}</a>
                    </h3>
                    <small> Unit: {{ $selasar->unit_pengelola }}</small>
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
                            <!--Gratis-->
                          @else
                            Rp. {{ number_format($selasar->price, 0) }}
                          @endif
                        </span>
                        @if ($selasar->price != 0)
                        <span class="price__text">Per {{ $selasar->price_for }}</span>
                        @endif
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


<!-- <div class="section-block"></div> -->


<!-- ================================
START LAPANGAN AREA
================================= -->
  <section class="car-area section-padding padding-top-20px padding-bottom-30px overflow-hidden">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
          <h2 class="sec__title line-height-55" style="font-size: 25px;">
            Lapangan
            </h2>
          </div>
          <!-- end section-heading -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-10px">
        <div class="col-lg-12">
          <div class="car-carousel carousel-action">
            @foreach ($lapangan as $lapangan)
              <div class="card-item car-card mb-0 border">
                <div class="card-img-top overflow-hidden" style="height: 250px; width: auto;">
                    <a href="{{ route('website.lapangan.show', $lapangan->id) }}" id="link-detail" class="d-block" style="display: block; width: 100%; height: 100%;">
                        @if ($lapangan->layanan_gambars->first())
                            <div style="width: 100%; height: 100%; background-image: url('{{ asset($lapangan->layanan_gambars[0]['picture']) }}'); background-size: cover; background-position: center;"></div>
                        @else
                            <div style="width: 100%; height: 100%; background-image: url('https://source.unsplash.com/600x400?rooms'); background-size: cover; background-position: center;"></div>
                        @endif
                    </a>
                </div>
                <div class="card-body">
                  <h3 class="card-title">
                    <a href="{{ route('website.lapangan.show', $lapangan->id) }}">{{ $lapangan->name }}</a>
                  </h3>
                  <small> Unit: {{ $lapangan->unit_pengelola }}</small>
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
                          <!--Gratis-->
                        @else
                          Rp. {{ number_format($lapangan->price, 0) }}
                        @endif
                      </span>
                      @if ($lapangan->price != 0)
                      <span class="price__text">Per {{ $lapangan->price_for }}</span>
                      @endif
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

<!-- ================================
START PERALATAN AREA
================================= -->
<section class="car-area section-padding padding-top-20px padding-bottom-30px overflow-hidden">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
          <h2 class="sec__title line-height-55" style="font-size: 25px;">
            Peralatan
            </h2>
          </div>
          <!-- end section-heading -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="row padding-top-10px">
        <div class="col-lg-12">
          <div class="car-carousel carousel-action">
            @foreach ($peralatan as $peralatan)
              <div class="card-item car-card mb-0 border">
                <div class="card-img-top overflow-hidden" style="height: 250px; width: auto;">
                    <a href="{{ route('website.peralatan.show', $peralatan->id) }}" id="link-detail" class="d-block" style="display: block; width: 100%; height: 100%;">
                        @if ($peralatan->layanan_gambars->first())
                            <div style="width: 100%; height: 100%; background-image: url('{{ asset($peralatan->layanan_gambars[0]['picture']) }}'); background-size: cover; background-position: center;"></div>
                        @else
                            <div style="width: 100%; height: 100%; background-image: url('https://source.unsplash.com/600x400?rooms'); background-size: cover; background-position: center;"></div>
                        @endif
                    </a>
                </div>
                <div class="card-body">
                  <h3 class="card-title">
                    <a href="{{ route('website.peralatan.show', $peralatan->id) }}">{{ $peralatan->name }}</a>
                  </h3>
                  <small> Unit: {{ $peralatan->unit_pengelola }}</small>
                  <div class="card-attributes">
                    <ul class="d-flex align-items-center">
                      <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                        title="Kapasitas">
                        <i class="la la-users"></i><span>{{ $peralatan->capacity }} Orang</span>
                      </li>
                    </ul>
                  </div>
                  <p class="card-meta">{{ $peralatan->address }}</p>
                  <div class="card-price d-flex align-items-center justify-content-between">
                    <p>
                      <span class="price__num">
                        @if ($peralatan->price == 0)
                          <!--Gratis-->
                        @else
                          Rp. {{ number_format($peralatan->price, 0) }}
                        @endif
                      </span>
                      @if ($peralatan->price != 0)
                      <span class="price__text">Per {{ $peralatan->price_for }}</span>
                      @endif
                    </p>
                    @if ($peralatan->is_sewa == 1)
                      <span class="price__text">Sedang Disewa</span>
                    @else
                      <a href="{{ route('website.peralatan.show', $peralatan->id) }}" class="btn-text">
                        Lihat<i class="la la-angle-right"></i>
                      </a>
                    @endif
                  </div>
                </div>
              </div>
              <!-- end card-item -->
            @endforeach
          </div>
          <!-- end peralatan-carousel -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="btn-box pt-3 text-center">
        <a href="{{ route('website.peralatan') }}" class="theme-btn">Lihat Peralatan Lainnya <i
            class="la la-arrow-right ml-1"></i></a>
      </div>
    </div>
    <!-- end container -->
  </section>
  <!-- end peralatan-area -->
<!-- ================================
END PERALATAN AREA
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
          <h2 class="sec__title line-height-55" style="font-size: 25px;">
            Laporan
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