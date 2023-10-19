@extends('layout.efacility.master')

@section('content')
  <!-- ================================
                                                                                                                                                                                                                                                                                                        START BREADCRUMB AREA
                                                                                                                                                                                                                                                                                                    ================================= -->
  <section class="check-availability-area section-bg section-padding">
    <div class="breadcrumb-wrap">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-12">
            <div class="search-result-content">
              <div class="section-heading">
                <h2 class="sec__title text-dark">Cari Selasar</h2>
              </div>
              <div class="search-fields-container margin-top-30px">
                <div class="contact-form-action">
                  <form action="#" class="row">
                    <div class="col-lg-3 col-sm-6 pr-0">
                      <div class="input-box">
                        <span class="la la-map-marker form-icon"></span>
                        <label class="label-text">Lokasi</label>
                        <div class="form-group">
                          <div class="select-contain select-contain-shadow w-auto">
                            <select id="location" class="select-contain-select">
                              <option value="">Pilih Lokasi</option>
                              <option value="GANESHA">ITB Kampus Ganesha</option>
                              <!-- <option value="SARAGA">Saraga</option> -->
                              <option value="JATINANGOR">ITB Kampus Jatinangor</option>
                              <option value="CIREBON">ITB Kampus Cirebon</option>
                              <option value="SBM JAKARTA">ITB Kampus Jakarta</option>
                              <option value="BOSSCHA">Bosscha</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div><!-- end col-lg-3 -->
                    <div class="col-lg-3 col-sm-6 pr-0">
                      <div class="input-box">
                        <span class="la la-building form-icon"></span>
                        <label class="label-text">Selasar</label>
                        <div class="form-group">
                          <input class="form-control" type="text" id="keyword" name="keyword"
                            placeholder="Nama Selasar" />
                        </div>
                      </div>
                    </div><!-- end col-lg-3 -->
                    <div class="col-lg-2 col-sm-6 pr-0">
                      <div class="input-box">
                        <span class="la la-calendar form-icon"></span>
                        <label class="label-text">Mulai!</label>
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
                    <div class="col-lg-2 col-sm-6">
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
                    <li><a href="#">Lihat Status Pinjaman</a></li>
                  </ul>
                </div>
              </div><!-- end search-fields-container -->
            </div><!-- end search-result-content -->
          </div><!-- end col-lg-12 -->
        </div><!-- end row -->
      </div><!-- end container -->
    </div><!-- end breadcrumb-wrap -->
  </section><!-- end breadcrumb-area -->
  <!-- ================================
                                                                                                                                                                                                                                                                                                      END BREADCRUMB AREA
                                                                                                                                                                                                                                                                                                    ================================= -->

  <!-- ================================
                                                                                                                                                                                                                                                                                                      START CARD AREA
                                                                                                                                                                                                                                                                                                    ================================= -->
  <section class="card-area section--padding">
    <div class="container">
      <div class="row" id="data-wrapper">
        @include('website.selasar._data')
      </div><!-- end row -->
      <div class="row">
        <div class="col-lg-12">
          <div class="btn-box mt-3 text-center">
            <button type="button" class="theme-btn load-more-data"><i class="la la-refresh mr-1"></i>Lihat Selasar
              Lainnya</button>
          </div><!-- end btn-box -->
        </div><!-- end col-lg-12 -->
      </div><!-- end row -->

      <!-- Data Loader -->
      <div class="title text-center no-more-data pt-3" style="display: none">Tidak ada data.</div>
      <div class="auto-load text-center" style="display: none">
        <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
          x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0"
          xml:space="preserve">
          <path fill="#000"
            d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
            <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50"
              to="360 50 50" repeatCount="indefinite" />
          </path>
        </svg>
      </div>
    </div><!-- end container -->
  </section><!-- end card-area -->
  <!-- ================================
                                                                                                                                                                                                                                                                                                      END CARD AREA
                                                                                                                                                                                                                                                                                                    ================================= -->
@endsection

@section('scripts')
  <script type="text/javascript">
    var ENDPOINT = "{{ route('website.selasar') }}";
    var page = 1;

    $(".load-more-data").click(function() {
      page++;
      infinteLoadMore(page);
    });

    $('#location').on('change', function() {
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
      // $('#link-detail').
    });

    /*------------------------------------------
    --------------------------------------------
    call infinteLoadMore()
    --------------------------------------------
    --------------------------------------------*/
    function infinteLoadMore(page) {
      var location = $('#location').val();
      var keyword = $('#keyword').val();
      var start_date = $('#start_date').val();
      var end_date = $('#end_date').val();

      $.ajax({
          url: ENDPOINT + "?page=" + page + "&location=" + location + "&start_date=" +
            start_date + "&keyword=" + keyword,
          datatype: "html",
          type: "get",
          beforeSend: function() {
            $('.no-more-data').hide();
            $('.auto-load').show();
          }
        })
        .done(function(response) {
          if (response.html == '') {
            // $('.auto-load').html("We don't have more data to display :(");
            $('.no-more-data').show();
            $('.auto-load').hide();
            return;
          }
          $('.auto-load').hide();
          $("#data-wrapper").append(response.html);
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
          console.log('Server error occured');
        });
    }
  </script>
@endsection
