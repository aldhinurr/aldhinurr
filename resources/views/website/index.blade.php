@extends('layout.trizen.master')

@section('content')
  <!-- ================================
                                                                                START ABOUT AREA
                                                                            ================================= -->
  <section class="about-area section--padding overflow-hidden">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="image-box about-img-box">
            <img src="https://source.unsplash.com/600x400?artline" alt="about-img" class="img__item img__item-1" />
          </div>
        </div>
        <!-- end col-lg-6 -->
        <div class="col-lg-6">
          <div class="about-content pr-5">
            <div class="section-heading">
              <h4 class="font-size-16 pb-2">Our Story</h4>
              <h2 class="sec__title">Atmosphere and Design</h2>
              <p class="sec__desc pt-4 pb-2">
                It is a long established fact that a reader will be distracted
                by the readable content of a page when looking at its layout.
                The point of using Lorem Ipsum is that it has a more-or-less
                normal distribution of letters
              </p>
              <p class="sec__desc">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. A
                accusamus amet consectetur ipsa officia. Doloremque error
                porro sit soluta totam! A iste nobis vel voluptatem!
              </p>
            </div>
            <!-- end section-heading -->
            <div class="btn-box pt-4">
              <a href="about.html" class="theme-btn">Read More <i class="la la-arrow-right ml-1"></i></a>
            </div>
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
  <section class="gallery-area section-padding">
    <div class="container">
      <div class="full-width-slider padding-top-30px carousel-action">
        <div class="full-width-slide-item">
          <a class="d-block" data-fancybox="gallery" href="https://source.unsplash.com/1200x800?building"
            data-caption="Showing image 1">
            <img src="https://source.unsplash.com/1200x800?university">
          </a>
        </div><!-- end full-width-slide-item -->
        <div class="full-width-slide-item">
          <a class="d-block" data-fancybox="gallery" href="https://source.unsplash.com/1200x800?event"
            data-caption="Showing image 2">
            <img src="https://source.unsplash.com/1200x800?event">
          </a>
        </div><!-- end full-width-slide-item -->
        <div class="full-width-slide-item">
          <a class="d-block" data-fancybox="gallery" href="https://source.unsplash.com/1200x800?study"
            data-caption="Showing image 3">
            <img src="https://source.unsplash.com/1200x800?study">
          </a>
        </div><!-- end full-width-slide-item -->
        <div class="full-width-slide-item">
          <a class="d-block" data-fancybox="gallery" href="https://source.unsplash.com/1200x800?technology"
            data-caption="Showing image 4">
            <img src="https://source.unsplash.com/1200x800?technology">
          </a>
        </div><!-- end full-width-slide-item -->
        <div class="full-width-slide-item">
          <a class="d-block" data-fancybox="gallery" href="https://source.unsplash.com/1200x800?ITB"
            data-caption="Showing image 5">
            <img src="https://source.unsplash.com/1200x800?ITB">
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
              <h4 class="info__title" style="font-size: 45px;">12</h4>
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
              <h4 class="info__title" style="font-size: 45px;">48</h4>
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
              <i class="la la-file-text"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content text-center">
              <h4 class="info__title" style="font-size: 45px;">60</h4>
              <h3 class="info__title">Laporan Tertangani</h3>
              </p>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
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
              <h3 class="sec__title">Ganesha</h3>
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
              <h3 class="sec__title">Saraga</h3>
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
              <h3 class="sec__title">Jatinangor</h3>
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
              <h3 class="sec__title">Cirebon</h3>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
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
                                                                                START HOTEL AREA
                                                                            ================================= -->
  <section class="hotel-area section-bg padding-top-50px padding-bottom-50px overflow-hidden">
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
      <div class="row padding-top-50px">
        <div class="col-lg-12">
          <div class="hotel-card-wrap">
            <div class="hotel-card-carousel-2 carousel-action">
              @foreach ($rooms as $room)
                <div class="card-item">
                  <div class="card-img">
                    <a href="{{ route('website.room.show', $room->id) }}" class="d-block">
                      @if ($room->layanan_gambars->first())
                        <img src="{{ asset($room->layanan_gambars[0]['picture']) }}" alt="hotel-img" />
                      @else
                        <img src="https://source.unsplash.com/600x400?rooms" alt="hotel-img" />
                      @endif
                    </a>
                  </div>
                  <div class="card-body">
                    <h3 class="card-title">
                      <a href="{{ route('website.room.show', $room->id) }}">{{ $room->name }}</a>
                    </h3>
                    <p class="card-meta">{{ $room->address }}</p>
                    <div class="card-price d-flex align-items-center justify-content-between">
                      <p>
                        <span class="price__num">Rp. {{ $room->price }}</span>
                        <span class="price__text">Per {{ $room->price_for }}</span>
                      </p>
                      <a href="{{ route('website.rooms') }}" class="btn-text">See details<i
                          class="la la-angle-right"></i></a>
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
        <a href="about.html" class="theme-btn">See More <i class="la la-arrow-right ml-1"></i></a>
      </div>
    </div>
    <!-- end container-fluid -->
  </section>
  <!-- end hotel-area -->
  <!-- ================================
                                                                                END HOTEL AREA
                                                                            ================================= -->

  <!-- ================================
                                                                            START CAR AREA
                                                                        ================================= -->
  <section class="car-area section-padding">
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
      <div class="row padding-top-50px">
        <div class="col-lg-12">
          <div class="car-carousel carousel-action">
            @foreach ($cars as $car)
              <div class="card-item car-card mb-0 border">
                <div class="card-img">
                  <a href="#" class="d-block">
                    <img src="https://source.unsplash.com/600x400?cars" alt="car-img" />
                  </a>
                </div>
                <div class="card-body">
                  {{-- <p class="card-meta">Compact SUV</p> --}}
                  <h3 class="card-title">
                    <a href="#">{{ $car->name }}</a>
                  </h3>
                  <div class="card-attributes">
                    <ul class="d-flex align-items-center">
                      <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                        title="Passenger">
                        <i class="la la-users"></i><span>4</span>
                      </li>
                      <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top"
                        title="Luggage">
                        <i class="la la-suitcase"></i><span>1</span>
                      </li>
                    </ul>
                  </div>
                  <div class="card-price d-flex align-items-center justify-content-between">
                    <p>
                      <span class="price__from">From</span>
                      <span class="price__num">Rp. {{ $car->price }}</span>
                      <span class="price__text">Per {{ $car->price_for }}</span>
                    </p>
                    <a href="#" class="btn-text">See details<i class="la la-angle-right"></i></a>
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
        <a href="about.html" class="theme-btn">See More <i class="la la-arrow-right ml-1"></i></a>
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
                                                                            START INFO AREA
                                                                        ================================= -->
  <section class="info-area padding-bottom-30px">
    <div class="container">
      <div class="row padding-top-50px">
        <div class="col-lg-4 responsive-column">
          <div class="icon-box icon-layout-3 d-flex">
            <div class="info-icon flex-shrink-0">
              <i class="la la-file-text"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content">
              <h4 class="info__title">2,000+ Local Guides</h4>
              <p class="info__desc">
                Lorem ipsum dolor sit amet, consectetur adipisicing
              </p>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-4 -->
        <div class="col-lg-4 responsive-column">
          <div class="icon-box icon-layout-3 d-flex">
            <div class="info-icon flex-shrink-0">
              <i class="la la-bullhorn"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content">
              <h4 class="info__title">Handcrafted Experiences</h4>
              <p class="info__desc">
                Lorem ipsum dolor sit amet, consectetur adipisicing
              </p>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
        <!-- end col-lg-4 -->
        <div class="col-lg-4 responsive-column">
          <div class="icon-box icon-layout-3 d-flex">
            <div class="info-icon flex-shrink-0">
              <i class="la la-users"></i>
            </div>
            <!-- end info-icon-->
            <div class="info-content">
              <h4 class="info__title">95% Happy Travelers</h4>
              <p class="info__desc">
                Lorem ipsum dolor sit amet, consectetur adipisicing
              </p>
            </div>
            <!-- end info-content -->
          </div>
          <!-- end icon-box -->
        </div>
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
@endsection
