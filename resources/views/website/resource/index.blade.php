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
  <!-- <section class="check-availability-area section-padding section-padding"> -->
  <setion><br><br>
    <div class="breadcrumb-wrap">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12">
            <div class="search-result-content">
              <div class="section-heading">
                <h2 class="sec__title text-dark"><i>Resource Sharing</i></h2>
              </div>
              <div class="search-fields-container margin-top-30px">
                <div class="contact-form-action">
                  <form action="#" class="row">
                  <div class="col-lg-3 col-sm-6 pr-0">
                      <div class="input-box">
                        <span class="la la-building form-icon"></span>
                        <label class="label-text">Jenis Layanan</label>
                        <div class="form-group">
                          <div class="select-contain select-contain-shadow w-auto">
                          <select id="endpoint-select" class="select-contain-select">
                              <option value="">Pilih Jenis</option>
                              <option value="ruang">Ruang</option>
                              <option value="rku">Ruang Kuliah Umum</option>
                              <option value="cars">Kendaraan</option>
                              <option value="lapangan">Lapangan</option>
                              <option value="selasar">Selasar</option>
                              <option value="peralatan">Peralatan</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end col-lg-3 -->
                    <div class="col-lg-3 col-sm-6 pr-0">
                      <div class="input-box">
                        <span class="la la-map-marker form-icon"></span>
                        <label class="label-text">Lokasi</label>
                        <div class="form-group">
                          <div class="select-contain select-contain-shadow w-auto">
                            <select id="location" class="select-contain-select">
                              <option value="">Pilih Lokasi</option>
                              <option value="GANESHA">ITB Kampus Ganesha</option>
                              <!-- <option value="SARAGA">Saraga</option>  -->
                              <option value="JATINANGOR">ITB Kampus Jatinangor</option>
                              <option value="CIREBON">ITB Kampus Cirebon</option>
                              <option value="JAKARTA">ITB Kampus Jakarta</option>
                              <!-- <option value="BOSSCHA">Bosscha</option> -->
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end col-lg-3 -->
                    <div class="col-lg-3 col-sm-6 pr-0">
                      <div class="input-box">
                        <span class="la la-building form-icon"></span>
                        <label class="label-text">Unit</label>
                        <div class="form-group">
                          <div class="select-contain select-contain-shadow w-auto">
                          <select id="unit_pengelola" class="select-contain-select">
                                <option value="">Pilih Unit</option>
                                @foreach($units as $unit)
                                    <option value="{{ $unit->unit_pengelola }}">{{ $unit->unit_pengelola }}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end col-lg-3 -->
                    <div class="col-lg-4 col-sm-6 pr-0">
                      <div class="input-box">
                        <span class="la la-building form-icon"></span>
                        <label class="label-text">Nama Layanan</label>
                        <div class="form-group">
                          <input class="form-control" type="text" id="keyword" name="keyword"
                            placeholder="Nama Layanan" />
                        </div>
                      </div>
                    </div><!-- end col-lg-3 -->
                    <div class="col-lg-2 col-sm-6 pr-0">
                      <div class="input-box">
                        <span class="la la-calendar form-icon"></span>
                        <label class="label-text">Mulai</label>
                        <div class="form-group">
                          <input class="date-range form-control" type="text" name="daterange-single" id="start_date" />
                        </div>
                      </div>
                    </div><!-- end col-lg-3 -->
                    <div class="col-lg-2 col-sm-6 pr-0">
                      <div class="input-box">
                        <span class="la la-calendar form-icon"></span>
                        <label class="label-text">Selesai</label>
                        <div class="form-group">
                          <input class="date-range form-control" type="text" name="daterange-single" id="end_date" />
                        </div>
                      </div>
                    </div><!-- end col-lg-3 -->
                    <div class="col-lg-1 col-sm-6">
                      <div class="input-box">
                        <label class="label-text"></label>
                        <div class="form-group pt-2">
                          <a href="#" class="col theme-btn text-center" id="cari">Cari</a>
                        </div>
                      </div>
                    </div><!-- end col-lg-3 -->
                  </form>
                </div><!-- end contact-form-action -->
                <div class="term-box">
                  <ul class="list-items list--items d-flex align-items-center">
                    <li><a href="/status">Cek Pesanan</a></li>
                  </ul>
                </div>
              </div><!-- end search-fields-container -->
            </div><!-- end search-result-content -->
          </div><!-- end col-lg-12 -->
        </div><!-- end row -->
      </div><!-- end container -->
    </div><!-- end breadcrumb-wrap -->
    <br>
  </section><!-- end breadcrumb-area -->

  <div id="showlayanan">
    <section>
    <hr style="width: 60%; margin: 0 auto;"><br>
      <div class="container">
        <div class="row">
        @foreach ($results as $result)
          <div class="col-lg-4 responsive-column">
            <div class="card-item">
              <div class="card-img-top overflow-hidden" style="width: 100%; height: 300px; /* Set your desired height */">
                  <a href="#" id="link-detail" class="d-block" style="display: block; width: 100%; height: 100%;">
                      @if ($result->layanan_gambars->first())
                          <div style="width: 100%; height: 100%; background-image: url('{{ asset($result->layanan_gambars[0]['picture']) }}'); background-size: cover; background-position: center;"></div>
                      @else
                          <div style="width: 100%; height: 100%; background-image: url('https://source.unsplash.com/600x400?rooms'); background-size: cover; background-position: center;"></div>
                      @endif
                  </a>
              </div>
              <div class="card-body">
                <h3 class="card-title">
                  <a href="#" id="link-detail">{{ $result->name }}</a>
                </h3>
                <small> Unit Pengelola: {{ $result->unit_pengelola }}</small>
                <div class="card-attributes">
                  <ul class="d-flex align-items-center">
                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Kapasitas">
                      <i class="la la-users"></i><span>{{ number_format($result->capacity) }} Orang</span>
                    </li>
                    <li class="d-flex align-items-center" data-toggle="tooltip" data-placement="top" title="Luas">
                      <i class="la la-expand"></i><span>{{ number_format($result->large) }} m<sup>2</sup></span>
                    </li>
                  </ul>
                </div>
                <p class="card-meta">{{ $result->address }}</p>
                <div class="card-price d-flex align-items-center justify-content-between">
                  <p>
                    <span class="price__num">
                      @if ($result->price == 0)
                        <!--Gratis-->
                      @else
                        Rp. {{ number_format($result->price, 0) }}
                      @endif
                    </span>
                    @if ($result->price != 0)
                    <span class="price__text">Per {{ $result->price_for }}</span>
                    @endif
                  </p>
                    @php
                        $linkPrefixes = [
                            'RKU' => 'rku',
                            'RUANG' => 'rooms',
                            'KENDARAAN' => 'car',
                            'SELASAR' => 'selasar',
                            'LAPANGAN' => 'lapangan',
                        ];
                        $linkPrefix = $linkPrefixes[$result->type] ?? 'default';
                    @endphp
                    <a href="{{ url($linkPrefix . '/' . $result->id . '/detail') }}" class="btn-text" id="link-detail">
                        Lihat<i class="la la-angle-right"></i>
                    </a>
                </div>
              </div>
            </div><!-- end card-item -->
          </div><!-- end col-lg-4 -->
        @endforeach
        </div><!-- end col-lg-4 -->
      </div><!-- end col-lg-4 -->
      <br>
    </section>
  </div>

  <section>
  <div id=section-wrapper>
  <hr style="width: 60%; margin: 0 auto;"><br>
  <div class="container">
      <div class="row" id="data-wrapper">
      </div><!-- end row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="btn-box mt-3 text-center">
            <button type="button" class="theme-btn load-more-data"><i class="la la-refresh mr-1"></i>Lihat
              Lainnya</button>
          </div><!-- end btn-box -->
        </div><!-- end col-lg-12 -->
      </div><!-- end row -->

      <!-- Data Loader -->
      <div class="title text-center no-more-data pt-3" style="display: none">Tidak ada data.</div>
      <!-- <div class="auto-load text-center" style="display: none">
        <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
          x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0"
          xml:space="preserve">
          <path fill="#000"
            d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
            <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50"
              to="360 50 50" repeatCount="indefinite" />
          </path>
        </svg>
      </div> -->
    </div><!-- end container -->
    <div><br><br>
  </section><!-- end card-area -->
@endsection

@section('scripts')
<script type="text/javascript">
    var ENDPOINTS = {
        ruang: "{{ route('website.rooms_resource') }}",
        rku: "{{ route('website.rku_resource') }}",
        cars: "{{ route('website.cars_resource') }}",
        lapangan: "{{ route('website.lapangan_resource') }}",
        selasar: "{{ route('website.selasar_resource') }}",
        peralatan: "{{ route('website.peralatan_resource') }}"
    };
    var page = 1;

    $('#endpoint-select').on('change', function() {
    var selectedValue = $(this).val();
    if (selectedValue === '') {
        // Jika memilih opsi kosong, tampilkan showlayanan dan sembunyikan section-wrapper
        $('#showlayanan').show();
        $('#section-wrapper').hide();
    } else {
        // Jika memilih opsi selain kosong, sembunyikan showlayanan dan tampilkan section-wrapper
        $('#showlayanan').hide();
        $('#section-wrapper').show();
    }
      ENDPOINT = ENDPOINTS[$(this).val()];
      page = 1;
      $("#data-wrapper").empty();
      infinteLoadMore(page);
    });

    $(".load-more-data").click(function() {
        page++;
        infinteLoadMore(page);
    });

    $('#location').on('change', function() {
        page = 1;
        $("#data-wrapper").empty();
        infinteLoadMore(page);
    });

    $('#unit_pengelola').on('change', function() {
        page = 1;
        $("#data-wrapper").empty();
        infinteLoadMore(page);
    });

    $('#cari').on('click', function() {
        page = 1;
        $("#data-wrapper").empty();
        infinteLoadMore(page);
    });

    $('#start_date').on('change', function() {
        console.log($(this).val());
    });

    function infinteLoadMore(page) {
        var location = $('#location').val();
        var unit_pengelola = $('#unit_pengelola').val();
        var keyword = $('#keyword').val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var price = 0;

        $.ajax({
            url: ENDPOINT + "?page=" + page + "&location=" + location + "&unit_pengelola=" + unit_pengelola + "&start_date=" +
              start_date + "&keyword=" + keyword + "&price=" + price,
            datatype: "html",
            type: "get",
            beforeSend: function() {
                $('.no-more-data').hide();
                $('.auto-load').show();
            }
        })
        .done(function(response) {
            if (response.html == '') {
                $('.no-more-data').show();
                $('.auto-load').hide();
                return;
            }
            $('.auto-load').hide();
            $("#data-wrapper").append(response.html);
            $("#section-wrapper").show();
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
            console.log('Server error occurred');
        });
    }

    // Initially hide section-wrapper
    $(document).ready(function() {
        $("#section-wrapper").hide();
    });
</script>
@endsection