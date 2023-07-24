@extends('layout.trizen.master')

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
                <h2 class="sec__title text-dark">Cari Ruangan</h2>
              </div>
              <div class="search-fields-container margin-top-30px">
                <div class="contact-form-action">
                  <form action="#" class="row">
                    <div class="col-lg-4 col-sm-6 pr-0">
                      <div class="input-box">
                        <span class="la la-map-marker form-icon"></span>
                        <label class="label-text">Lokasi</label>
                        <div class="form-group">
                          <div class="select-contain select-contain-shadow w-auto">
                            <select id="location" class="select-contain-select">
                              <option value="">Pilih Lokasi</option>
                              <option value="GANESHA">Ganesha</option>
                              <option value="SARAGA">Saraga</option>
                              <option value="JATINANGOR">Jatinangor</option>
                              <option value="CIREBON">Cirebon</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div><!-- end col-lg-3 -->
                    <div class="col-lg-3 col-sm-6 pr-0">
                      <div class="input-box">
                        <span class="la la-calendar form-icon"></span>
                        <label class="label-text">Mulai</label>
                        <div class="form-group">
                          <input class="date-range form-control" type="text" name="daterange-single" id="start_date" />
                        </div>
                      </div>
                    </div><!-- end col-lg-3 -->
                    <div class="col-lg-3 col-sm-6 pr-0">
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
                          <a href="#" class="col theme-btn text-center">Cari</a>
                        </div>
                      </div>
                    </div><!-- end col-lg-3 -->
                  </form>
                </div><!-- end contact-form-action -->
                {{-- <div class="advanced-wrap">
                  <a class="btn collapse-btn theme-btn-hover-gray font-size-15" data-toggle="collapse" href="#collapseTwo"
                    role="button" aria-expanded="false" aria-controls="collapseTwo">
                    More option <i class="la la-angle-down ml-1"></i>
                  </a>
                  <div class="pt-3 collapse" id="collapseTwo">
                    <div class="slider-range-wrap ">
                      <div class="price-slider-amount padding-bottom-20px">
                        <label for="amount" class="filter__label">Price:</label>
                        <input type="text" id="amount" class="amounts" readonly>
                      </div><!-- end price-slider-amount -->
                      <div id="slider-range"></div><!-- end slider-range -->
                    </div><!-- end slider-range-wrap -->
                    <div class="checkbox-wrap padding-top-30px">
                      <h3 class="title font-size-15 pb-3">Hotel Facilities</h3>
                      <div class="custom-checkbox d-inline-block mr-4">
                        <input type="checkbox" id="c1">
                        <label for="c1">Air Conditioning</label>
                      </div>
                      <div class="custom-checkbox d-inline-block mr-4">
                        <input type="checkbox" id="c2">
                        <label for="c2">Airport Transport</label>
                      </div>
                      <div class="custom-checkbox d-inline-block mr-4">
                        <input type="checkbox" id="c3">
                        <label for="c3">Fitness Center</label>
                      </div>
                      <div class="custom-checkbox d-inline-block mr-4">
                        <input type="checkbox" id="c4">
                        <label for="c4">Flat Tv</label>
                      </div>
                      <div class="custom-checkbox d-inline-block mr-4">
                        <input type="checkbox" id="c5">
                        <label for="c5">Heater</label>
                      </div>
                      <div class="custom-checkbox d-inline-block mr-4">
                        <input type="checkbox" id="c6">
                        <label for="c6">Internet - wi-fi</label>
                      </div>
                      <div class="custom-checkbox d-inline-block mr-4">
                        <input type="checkbox" id="c7">
                        <label for="c7">Parking</label>
                      </div>
                      <div class="custom-checkbox d-inline-block mr-4">
                        <input type="checkbox" id="c8">
                        <label for="c8">Pool</label>
                      </div>
                      <div class="custom-checkbox d-inline-block mr-4">
                        <input type="checkbox" id="c9">
                        <label for="c9">Restaurant</label>
                      </div>
                      <div class="custom-checkbox d-inline-block mr-4">
                        <input type="checkbox" id="c10">
                        <label for="c10">Smoking Room</label>
                      </div>
                      <div class="custom-checkbox d-inline-block mr-4">
                        <input type="checkbox" id="c11">
                        <label for="c11">Spa & Sauna</label>
                      </div>
                      <div class="custom-checkbox d-inline-block mr-4">
                        <input type="checkbox" id="c12">
                        <label for="c12">Washer & Dryer</label>
                      </div>
                    </div>
                  </div>
                </div> --}}
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
      {{-- <div class="row">
        <div class="col-lg-12">
          <div class="filter-wrap margin-bottom-30px">
            <div class="filter-top d-flex align-items-center justify-content-between pb-4">
              <div>
                <h3 class="title font-size-24">New York: 24 Hotels found</h3>
                <p class="font-size-14"><span class="mr-1 pt-1">Book with confidence:</span>No hotel booking fees</p>
              </div>
              <div class="layout-view d-flex align-items-center">
                <a href="hotel-grid.html" data-toggle="tooltip" data-placement="top" title="Grid View" class="active"><i
                    class="la la-th-large"></i></a>
                <a href="hotel-list.html" data-toggle="tooltip" data-placement="top" title="List View"><i
                    class="la la-th-list"></i></a>
              </div>
            </div><!-- end filter-top -->
            <div class="filter-bar d-flex align-items-center justify-content-between">
              <div class="filter-bar-filter d-flex flex-wrap align-items-center">
                <div class="filter-option">
                  <h3 class="title font-size-16">Filter by:</h3>
                </div>
                <div class="filter-option">
                  <div class="dropdown dropdown-contain">
                    <a class="dropdown-toggle dropdown-btn dropdown--btn" href="#" role="button"
                      data-toggle="dropdown">
                      Filter Price
                    </a>
                    <div class="dropdown-menu dropdown-menu-wrap">
                      <div class="dropdown-item">
                        <div class="slider-range-wrap">
                          <div class="price-slider-amount padding-bottom-20px">
                            <label for="amount2" class="filter__label">Price:</label>
                            <input type="text" id="amount2" class="amounts">
                          </div><!-- end price-slider-amount -->
                          <div id="slider-range2"></div><!-- end slider-range -->
                        </div><!-- end slider-range-wrap -->
                        <div class="btn-box pt-4">
                          <button class="theme-btn theme-btn-small theme-btn-transparent" type="button">Apply</button>
                        </div>
                      </div><!-- end dropdown-item -->
                    </div><!-- end dropdown-menu -->
                  </div><!-- end dropdown -->
                </div>
                <div class="filter-option">
                  <div class="dropdown dropdown-contain">
                    <a class="dropdown-toggle dropdown-btn dropdown--btn" href="#" role="button"
                      data-toggle="dropdown">
                      Review Score
                    </a>
                    <div class="dropdown-menu dropdown-menu-wrap">
                      <div class="dropdown-item">
                        <div class="checkbox-wrap">
                          <div class="custom-checkbox">
                            <input type="checkbox" id="r1">
                            <label for="r1">
                              <span class="ratings d-flex align-items-center">
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <span class="color-text-3 font-size-13 ml-1">(55.590)</span>
                              </span>
                            </label>
                          </div>
                          <div class="custom-checkbox">
                            <input type="checkbox" id="r2">
                            <label for="r2">
                              <span class="ratings d-flex align-items-center">
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star-o"></i>
                                <span class="color-text-3 font-size-13 ml-1">(40.590)</span>
                              </span>
                            </label>
                          </div>
                          <div class="custom-checkbox">
                            <input type="checkbox" id="r3">
                            <label for="r3">
                              <span class="ratings d-flex align-items-center">
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star-o"></i>
                                <i class="la la-star-o"></i>
                                <span class="color-text-3 font-size-13 ml-1">(23.590)</span>
                              </span>
                            </label>
                          </div>
                          <div class="custom-checkbox">
                            <input type="checkbox" id="r4">
                            <label for="r4">
                              <span class="ratings d-flex align-items-center">
                                <i class="la la-star"></i>
                                <i class="la la-star"></i>
                                <i class="la la-star-o"></i>
                                <i class="la la-star-o"></i>
                                <i class="la la-star-o"></i>
                                <span class="color-text-3 font-size-13 ml-1">(12.590)</span>
                              </span>
                            </label>
                          </div>
                          <div class="custom-checkbox">
                            <input type="checkbox" id="r5">
                            <label for="r5">
                              <span class="ratings d-flex align-items-center">
                                <i class="la la-star"></i>
                                <i class="la la-star-o"></i>
                                <i class="la la-star-o"></i>
                                <i class="la la-star-o"></i>
                                <i class="la la-star-o"></i>
                                <span class="color-text-3 font-size-13 ml-1">(590)</span>
                              </span>
                            </label>
                          </div>
                        </div>
                      </div><!-- end dropdown-item -->
                    </div><!-- end dropdown-menu -->
                  </div><!-- end dropdown -->
                </div>
                <div class="filter-option">
                  <div class="dropdown dropdown-contain">
                    <a class="dropdown-toggle dropdown-btn dropdown--btn" href="#" role="button"
                      data-toggle="dropdown">
                      Facilities
                    </a>
                    <div class="dropdown-menu dropdown-menu-wrap">
                      <div class="dropdown-item">
                        <div class="checkbox-wrap">
                          <div class="custom-checkbox">
                            <input type="checkbox" id="catChb1">
                            <label for="catChb1">Pet Allowed</label>
                          </div>
                          <div class="custom-checkbox">
                            <input type="checkbox" id="catChb2">
                            <label for="catChb2">Groups Allowed</label>
                          </div>
                          <div class="custom-checkbox">
                            <input type="checkbox" id="catChb3">
                            <label for="catChb3">Tour Guides</label>
                          </div>
                          <div class="custom-checkbox">
                            <input type="checkbox" id="catChb4">
                            <label for="catChb4">Access for disabled</label>
                          </div>
                          <div class="custom-checkbox">
                            <input type="checkbox" id="catChb5">
                            <label for="catChb5">Room Service</label>
                          </div>
                          <div class="custom-checkbox">
                            <input type="checkbox" id="catChb6">
                            <label for="catChb6">Parking</label>
                          </div>
                          <div class="custom-checkbox">
                            <input type="checkbox" id="catChb7">
                            <label for="catChb7">Restaurant</label>
                          </div>
                          <div class="custom-checkbox">
                            <input type="checkbox" id="catChb8">
                            <label for="catChb8">Pet friendly</label>
                          </div>
                        </div>
                      </div><!-- end dropdown-item -->
                    </div><!-- end dropdown-menu -->
                  </div><!-- end dropdown -->
                </div>
              </div><!-- end filter-bar-filter -->
              <div class="select-contain">
                <select class="select-contain-select">
                  <option value="1">Short by default</option>
                  <option value="2">Popular Hotel</option>
                  <option value="3">Price: low to high</option>
                  <option value="4">Price: high to low</option>
                  <option value="5">A to Z</option>
                </select>
              </div><!-- end select-contain -->
            </div><!-- end filter-bar -->
          </div><!-- end filter-wrap -->
        </div><!-- end col-lg-12 -->
      </div><!-- end row --> --}}

      @include('website.rooms._data')

      <div class="row">
        <div class="col-lg-12">
          <div class="btn-box mt-3 text-center">
            <button type="button" class="theme-btn load-more-data"><i class="la la-refresh mr-1"></i>Load
              More</button>
          </div><!-- end btn-box -->
        </div><!-- end col-lg-12 -->
      </div><!-- end row -->

      <!-- Data Loader -->
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
    var ENDPOINT = "{{ route('website.rooms') }}";
    var page = 1;

    $(".load-more-data").click(function() {
      page++;
      infinteLoadMore(page);
    });

    /*------------------------------------------
    --------------------------------------------
    call infinteLoadMore()
    --------------------------------------------
    --------------------------------------------*/
    function infinteLoadMore(page) {
      $.ajax({
          url: ENDPOINT + "?page=" + page,
          datatype: "html",
          type: "get",
          beforeSend: function() {
            $('.auto-load').show();
          }
        })
        .done(function(response) {
          if (response.html == '') {
            $('.auto-load').html("We don't have more data to display :(");
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
