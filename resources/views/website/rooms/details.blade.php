@extends('layout.efacility.master')

@section('content')
  <!-- ================================
                                                                                                                                                                                                                                                START BREADCRUMB TOP BAR
                                                                                                                                                                                                                                            ================================= -->
  <section class="breadcrumb-top-bar">
    <div class="container">
      <div class="row justify-content-between">
        <div class="single-content-item pb-4">
          <h3 class="title font-size-26">{{ $data->name }}</h3>
          <p class="pt-2">
            <span class="la la-map-marker font-size-48"></span>
            {{ $data->address }}
          <h6 class="info__title">{{ $data->location }}</h6>
          <span class="info__desc pt-1">Luas: {{ $data->large }} m<sup>2</sup>, Kapasitas: {{ $data->capacity }}
            Orang</span>
          </p>
        </div><!-- end single-content-item -->
        <div class="single-content-item pb-4 pt-4 text-right">
          <h3 class="title font-size-26 pb-2">Rp. {{ number_format($data->price, 0) }} / {{ $data->price_for }}</h3>
          <a href="{{ route('website.rooms') }}" class="theme-btn theme-btn-small"><i class="la la-arrow-left"></i>
            Kembali</a>
        </div><!-- end single-content-item -->
      </div>
      <div class="section-block"></div>
    </div><!-- end container -->
  </section><!-- end breadcrumb-top-bar -->
  <!-- ================================
                                                                                                                                                                                                                                                END BREADCRUMB TOP BAR
                                                                                                                                                                                                                                            ================================= -->

  <!-- ================================
                                                                                                                                                                                                                                                START ROOM DETAIL BREAD
                                                                                                                                                                                                                                            ================================= -->
  <section class="room-detail-bread padding-top-10px">
    <div class="container">
      @if (count($room_pictures) > 0)
        <div class="full-width-slider carousel-action">
          @foreach ($room_pictures as $image)
            <div class="full-width-slide-item">
              <a class="d-block" data-fancybox="gallery" href="{{ asset($image['picture']) }}"
                data-caption="Showing image">
                <img src="{{ asset($image['picture']) }}" style="height: 600px; width: auto">
              </a>
            </div>
          @endforeach
          {{-- <div class="full-width-slide-item">
          <a class="d-block" data-fancybox="gallery" href="https://source.unsplash.com/1200x800?event"
            data-caption="Showing image 2">
            <img src="https://source.unsplash.com/1200x800?event">
          </a>
        </div><!-- end full-width-slide-item --> --}}
        </div><!-- end full-width-slider -->
      @else
        <h3 class="title font-size-26 text-center padding-top-100px padding-bottom-200px">Gambar Belum Tersedia</h3>
      @endif
    </div>
  </section><!-- end room-detail-bread -->
  <!-- ================================
                                                                                                                                                                                                                                                END ROOM DETAIL BREAD
                                                                                                                                                                                                                                            ================================= -->

  <!-- ================================
                                                                                                                                                                                                                                                START TOUR DETAIL AREA
                                                                                                                                                                                                                                            ================================= -->
  <section class="tour-detail-area padding-bottom-70px">
    <div class="single-content-box">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="single-content-wrap padding-top-60px">
              <div id="description" class="page-scroll">
                <div class="single-content-item padding-top-30px padding-bottom-40px">
                  <h3 class="title font-size-20 py-3">Tentang</h3>
                  {!! $data->description !!}
                </div><!-- end single-content-item -->
                <div class="section-block"></div>
              </div><!-- end description -->
              <div id="facilities" class="page-scroll">
                <div class="single-content-item padding-top-40px padding-bottom-40px">
                  <h3 class="title font-size-20">Fasilitas</h3>
                  <div class="row pt-4">
                    @foreach ($service_facilities as $facilities)
                      @if ($facilities->type == 'UTAMA')
                        <div class="col-lg-6">
                          <div class="single-tour-feature d-flex align-items-center mb-3">
                            <div class="single-feature-icon icon-element ml-0 flex-shrink-0 mr-3">
                              <i class="la la-{{ $facilities->facility->icon }}"></i>
                            </div>
                            <div class="row col-lg-8 d-flex justify-content-between">
                              <h3 class="title font-size-15 font-weight-medium">{{ $facilities->facility->name }}</h3>
                              <h6 class="title font-size-15 text-muted">{{ $facilities->quantity }}
                                {{ $facilities->facility->satuan }}
                              </h6>
                            </div>
                          </div><!-- end single-tour-feature -->
                        </div><!-- end col-lg-4 -->
                      @endif
                    @endforeach
                  </div><!-- end row -->
                </div><!-- end single-content-item -->
                <div class="section-block"></div>
              </div><!-- end itinerary -->
              <div id="contacts" class="page-scroll">
                @include('website.partials._contacts')
                <div class="section-block"></div>
              </div><!-- end itinerary -->
            </div><!-- end single-content-wrap -->
          </div><!-- end col-lg-8 -->
          <div class="col-lg-4">
            @include('website.partials._reservation')
          </div><!-- end col-lg-4 -->
        </div><!-- end row -->
      </div><!-- end container -->
    </div><!-- end single-content-box -->
  </section><!-- end tour-detail-area -->
  <!-- ================================
                                                                                                                                                                                                                                                END TOUR DETAIL AREA
                                                                                                                                                                                                                                            ================================= -->

  <!-- ================================
                                                                                                                                                                                                                                                START RELATE TOUR AREA
                                                                                                                                                                                                                                            ================================= -->
  <section class="related-tour-area section--padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="section-heading">
            <h2 class="sec__title line-height-55">
              Ruangan Lainnya
            </h2>
          </div>
          <!-- end section-heading -->
        </div>
        <!-- end col-lg-12 -->
      </div>
      <!-- end row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="hotel-card-wrap">
            <div class="hotel-card-carousel-2 carousel-action">
              @foreach ($other_rooms as $room)
                <div class="card-item">
                  <div class="card-img-top overflow-hidden" style="height: 250px; width: auto;">
                    <a href="{{ route('website.room.show', $room->id) }}" id="link-detail" class="d-block">
                      @if ($room->layanan_gambars->first())
                        <img src="{{ asset($room->layanan_gambars[0]['picture']) }}" alt="hotel-img" />
                      @else
                        <img src="https://source.unsplash.com/600x400?rooms" alt="hotel-img" />
                      @endif
                    </a>
                  </div>
                  <div class="card-body">
                    <h3 class="card-title">
                      <a href="{{ route('website.room.show', $room->id) }}" id="link-detail">{{ $room->name }}</a>
                    </h3>
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
                      <a href="{{ route('website.room.show', $room->id) }}" id="link-detail" class="btn-text">
                        See details<i class="la la-angle-right"></i>
                      </a>
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
  </section><!-- end related-tour-area -->
  <!-- ================================
                                                                                                                                                                                                                                                END RELATE TOUR AREA
                                                                                                                                                                                                                                            ================================= -->
@endsection

@section('scripts')
  @include('website.partials._reservation-script')
@endsection
