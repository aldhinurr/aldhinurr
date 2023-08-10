@extends('layout.efacility.master')

@section('styles')
  <link href="{{ asset('demo1/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
  <section class="card-area section--padding">

    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h3 class="title font-size-24">Status</h3>
          <div class="section-tab section-tab-3 pt-4">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="my-sewa-tab" data-toggle="tab" href="#my-sewa" role="tab"
                  aria-controls="my-sewa" aria-selected="true">
                  Sewa
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="my-laporan-tab" data-toggle="tab" href="#my-laporan" role="tab"
                  aria-controls="my-laporan" aria-selected="false">
                  Laporan
                </a>
              </li>
            </ul>
          </div><!-- end section-tab -->
          <div class="tab-content padding-top-10px margin-bottom-40px" id="myTabcontent">
            <div class="tab-pane fade show active" id="my-sewa" role="tabpanel" aria-labelledby="my-sewa-tab">
              <div class="filter-wrap margin-bottom-30px">
                <div class="filter-bar d-flex align-items-center justify-content-between">
                  <div class="filter-bar-filter d-flex flex-wrap align-items-center">
                    <div class="filter-option">
                      <div class="checkbox-wrap pt-1">
                        <div class="custom-checkbox">
                          <input type="checkbox" id="only_me" name="only_me" value=1>
                          <label for="only_me">
                            <h3 class="title font-size-16 pt-1">Saya</h3>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="filter-option">
                      <div class="select-contain">
                        <select id="type-sewa" name="type-sewa" class="select-contain-select">
                          <option value="RUANG">Ruangan</option>
                          <option value="KENDARAAN">Kendaraan</option>
                        </select>
                      </div><!-- end select-contain -->
                    </div>
                    <div class="filter-option">
                      <div class="contact-form-action">
                        <div class="form-group mb-0">
                          <input class="form-control" type="text" id="search-sewa" name="search-sewa"
                            placeholder="Cari" style="padding-left: 20px">
                          <button class="search-btn"><i class="la la-search"></i></button>
                        </div>
                      </div>
                    </div>
                  </div><!-- end filter-bar-filter -->
                  <div class="section-tab section-tab-3">
                    <ul class="nav nav-tabs" id="myTabDetail">
                      <li class="nav-item">
                        <a class="nav-link active" id="my-sewa-calendar-tab" data-toggle="tab" href="#my-sewa-calendar"
                          role="tab" aria-controls="my-sewa-calendar" aria-selected="true">
                          <i class="la la-calendar"></i>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="my-sewa-table-tab" data-toggle="tab" href="#my-sewa-table" role="tab"
                          aria-controls="my-sewa-table" aria-selected="true">
                          <i class="la la-th-list"></i>
                        </a>
                      </li>
                    </ul>
                    {{-- <a href="hotel-grid.html" data-toggle="tooltip" data-placement="top" title="Tabel" class="active"><i
                        class="la la-th-list"></i></a>
                    <a href="hotel-list.html" data-toggle="tooltip" data-placement="top" title="Kalender"><i
                        class="la la-calendar"></i></a> --}}
                  </div>
                </div><!-- end filter-bar -->
              </div><!-- end filter-wrap -->

              <div class="tab-content padding-top-10px margin-bottom-40px" id="myTabcontent">
                <div class="tab-pane fade show active" id="my-sewa-calendar" role="tabpanel"
                  aria-labelledby="my-sewa-calendar-tab">
                  <div class="form-box">
                    <div class="form-content">
                      <div id="kt_docs_fullcalendar_basic"></div>
                    </div>
                  </div><!-- end form-box -->
                </div>
                <div class="tab-pane fade show" id="my-sewa-table" role="tabpanel" aria-labelledby="my-sewa-table-tab">
                  <div class="form-box">
                    <div class="form-content">
                      <div class="table-form table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Type</th>
                              <th scope="col">Nama</th>
                              <th scope="col">Lokasi</th>
                              <th scope="col">Mulai</th>
                              <th scope="col">Selesai</th>
                              <th scope="col">Pengguna</th>
                              <th scope="col">Status</th>
                              <th scope="col">Opsi</th>
                            </tr>
                          </thead>
                          <tbody id="sewa-data">
                            @include('website.status._data-sewa')
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div><!-- end form-box -->
                </div>
              </div>
            </div><!-- end tab-pane -->
            <div class="tab-pane fade" id="my-laporan" role="tabpanel" aria-labelledby="my-laporan-tab">
              <div class="filter-wrap margin-bottom-30px">
                <div class="filter-bar d-flex align-items-center justify-content-between">
                  <div class="filter-bar-filter d-flex flex-wrap align-items-center">
                    <div class="filter-option">
                      <div class="checkbox-wrap pt-1">
                        <div class="custom-checkbox">
                          <input type="checkbox" id="only_me-report" name="only_me-report" value=1>
                          <label for="only_me-report">
                            <h3 class="title font-size-16 pt-1">Saya</h3>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="filter-option">
                      <div class="select-contain">
                        <select id="type-report" name="type-report" class="select-contain-select">
                          <option value="Laporan Kerusakan">Laporan Kerusakan</option>
                          <option value="Laporan Kebersihan">Laporan Kebersihan</option>
                          <option value="Laporan Keamanan<">Laporan Keamanan</option>
                        </select>
                      </div><!-- end select-contain -->
                    </div>
                    <div class="filter-option">
                      <div class="contact-form-action">
                        <div class="form-group mb-0">
                          <input class="form-control" type="text" id="search-report" name="search-report"
                            placeholder="Cari" style="padding-left: 20px">
                          <button class="search-btn"><i class="la la-search"></i></button>
                        </div>
                      </div>
                    </div>
                  </div><!-- end filter-bar-filter -->
                  <div class="section-tab section-tab-3">
                    <ul class="nav nav-tabs" id="myTabDetail">
                      <li class="nav-item">
                        <a class="nav-link active" id="my-report-calendar-tab" data-toggle="tab"
                          href="#my-report-calendar" role="tab" aria-controls="my-report-calendar"
                          aria-selected="true">
                          <i class="la la-calendar"></i>
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="my-report-table-tab" data-toggle="tab" href="#my-report-table"
                          role="tab" aria-controls="my-report-table" aria-selected="true">
                          <i class="la la-th-list"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div><!-- end filter-bar -->
              </div><!-- end filter-wrap -->

              <div class="tab-content padding-top-10px margin-bottom-40px" id="myTabcontent">
                <div class="tab-pane fade show active" id="my-report-calendar" role="tabpanel"
                  aria-labelledby="my-report-calendar-tab">
                  <div class="form-box">
                    <div class="form-content">
                      <div id="kt_docs_fullcalendar_report"></div>
                    </div>
                  </div><!-- end form-box -->
                </div>
                <div class="tab-pane fade show" id="my-report-table" role="tabpanel"
                  aria-labelledby="my-report-table-tab">
                  <div class="form-box">
                    <div class="form-content">
                      <div class="table-form table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th scope="col">Tanggal</th>
                              <th scope="col">Laporan</th>
                              <th scope="col">Keterangan</th>
                              <th scope="col">Pelapor</th>
                              <th scope="col">Status</th>
                              <th scope="col">Opsi</th>
                            </tr>
                          </thead>
                          <tbody id="report-data">
                            @include('website.status._data-report')
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div><!-- end form-box -->
                </div>
              </div>
            </div><!-- end tab-pane -->
          </div>
        </div><!-- end col-lg-9 -->
      </div><!-- end row -->
    </div><!-- end container -->
  </section><!-- end card-area -->
  @include('website.status._modal-calendar')
@endsection

@section('scripts')
  <script src="{{ asset('demo1/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
  <script>
    $(document).ready(function() {
      window.onload = function() {

        var url = document.location.toString();
        if (url.match('#')) {
          $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
          calendar.refetchEvents();
          calendarReport.refetchEvents();
        }

        //Change hash for page-reload
        $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').on('shown', function(e) {
          window.location.hash = e.target.hash;
        });
      }

      const fetch_data = (page, type, seach_term, only_me) => {
        if (page === undefined) {
          page = 1;
        }

        if (type === undefined) {
          type = "";
        }

        if (seach_term === undefined) {
          seach_term = "";
        }

        if (only_me === undefined) {
          only_me = "";
        }

        var url = "{{ route('website.status') }}?page=" + page + "&type=" + type + "&seach_term=" + seach_term +
          "&only_me=" + only_me
        $.ajax({
          url: url,
          success: function(data) {
            $('#sewa-data').html('');
            $('#sewa-data').html(data);
          }
        })
      }

      $('body').on('keyup', '#search-sewa', function() {
        var page = $('#hidden_page').val();
        var type = $('#type-sewa').val();
        var seach_term = $('#search-sewa').val();
        var only_me = $('#only_me:checked').val();

        fetch_data(page, type, seach_term, only_me);
        calendar.refetchEvents();
      });

      $('body').on('change', '#type-sewa', function() {
        var type = $('#type-sewa').val();
        var seach_term = $('#search-sewa').val();
        var page = $('#hidden_page').val();
        var only_me = $('#only_me:checked').val();

        fetch_data(page, type, seach_term, only_me);
        calendar.refetchEvents();
      });

      $('body').on('click', '#pagination-sewa a', function(event) {
        event.preventDefault();

        var page = $(this).attr('href').split('page=')[1];
        $('#hidden_page').val(page);

        var type = $('#type-sewa').val();
        var seach_term = $('#search-sewa').val();
        var only_me = $('#only_me:checked').val();

        fetch_data(page, type, seach_term, only_me);
      });

      $("input[name='only_me']").change(function() {
        if (this.checked) {
          @if (!Auth::check())
            alert("Silahkan masuk ke akun Anda terlebih dahulu.");
            window.location = "{{ route('login') }}";
          @endif
        }

        var type = $('#type-sewa').val();
        var seach_term = $('#search-sewa').val();
        var page = $('#hidden_page').val();
        var only_me = $('#only_me:checked').val();

        fetch_data(page, type, seach_term, only_me);
        calendar.refetchEvents();
      });

      $('#my-sewa-tab').on('click', function() {
        calendar.refetchEvents();
      });


      var todayDate = moment().startOf("day");
      var YM = todayDate.format("YYYY-MM");
      var YESTERDAY = todayDate.clone().subtract(1, "day").format("YYYY-MM-DD");
      var TODAY = todayDate.format("YYYY-MM-DD");
      var TOMORROW = todayDate.clone().add(1, "day").format("YYYY-MM-DD");

      var calendarEl = document.getElementById("kt_docs_fullcalendar_basic");
      var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
          left: "prev,next today",
          center: "title",
          right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
        },

        height: 760,
        contentHeight: 700,
        // aspectRatio: 3, // see: https://fullcalendar.io/docs/aspectRatio

        nowIndicator: true,
        now: TODAY,

        views: {
          dayGridMonth: {
            buttonText: "month"
          },
          timeGridWeek: {
            buttonText: "week"
          },
          timeGridDay: {
            buttonText: "day"
          }
        },

        initialView: "dayGridMonth",
        initialDate: TODAY,

        editable: false,
        dayMaxEvents: true, // allow "more" link when too many events
        navLinks: true,
        displayEventTime: false,
        selectable: true,
        // events: "{{ route('website.status.calendar') }}",
        events: {
          url: "{{ route('website.status.calendar') }}",
          method: 'GET',
          extraParams: function() {
            /*
              Here we will grab the values of each of our filter input
              These will then be sent to the server
            */

            var only_me = $('#only_me:checked').val();
            if (only_me === undefined) {
              only_me = "";
            }

            return {
              type: $('[name="type-sewa"]').val(),
              search: $('[name="search-sewa"]').val(),
              only_me: only_me
            };
          }
        },
        eventContent: function(info) {
          var element = $(info.el);

          if (info.event.extendedProps && info.event.extendedProps.description) {
            if (element.hasClass("fc-day-grid-event")) {
              element.data("content", info.event.extendedProps.description);
              element.data("placement", "top");
              KTApp.initPopover(element);
            } else if (element.hasClass("fc-time-grid-event")) {
              element.find(".fc-title").append("<div class='fc-description'>" + info.event.extendedProps
                .description + "</div>");
            } else if (element.find(".fc-list-item-title").lenght !== 0) {
              element.find(".fc-list-item-title").append("<div class='fc-description'>" + info.event
                .extendedProps.description + "</div>");
            }
          }
        },
        eventClick: function(info) {
          var redirect_url = "{{ route('website.reservation.show', ':id') }}"

          $('#eventDetailTitle').text(info.event.extendedProps.layanan);
          $('#address').text(info.event.extendedProps.address);
          $('#location').text(info.event.extendedProps.location);
          $('#pengguna').text(`${info.event.extendedProps.first_name} ${info.event.extendedProps.last_name}`);
          $('#start_date').text(info.event.start.toLocaleString("id-ID"));
          $('#end_date').text(
            (info.event.end != null ? info.event.end.toLocaleString("id-ID") :
              info.event.start.toLocaleString("id-ID")));
          $('#duration').text(`${info.event.extendedProps.fee_for} ${info.event.extendedProps.price_for}`);
          $('#catatan').text(info.event.extendedProps.catatan);
          $('#description').text(info.event.extendedProps.description);
          $('#link-detail').attr("href", redirect_url.replace(':id', info.event.id));
          $('#eventDetail').modal();
        }
      });
      calendar.render();

      // report
      const fetch_data_report = (page, type, seach_term, only_me) => {
        if (page === undefined) {
          page = 1;
        }

        if (type === undefined) {
          type = "";
        }

        if (seach_term === undefined) {
          seach_term = "";
        }

        if (only_me === undefined) {
          only_me = "";
        }

        var url = "{{ route('website.status.report') }}?page=" + page + "&type=" + type + "&seach_term=" +
          seach_term +
          "&only_me=" + only_me
        $.ajax({
          url: url,
          success: function(data) {
            $('#report-data').html('');
            $('#report-data').html(data);
          }
        })
      };

      $('body').on('keyup', '#search-report', function() {
        var page = $('#hidden_page_report').val();
        var type = $('#type-report').val();
        var seach_term = $('#search-report').val();
        var only_me = $('#only_me-report:checked').val();

        fetch_data_report(page, type, seach_term, only_me);
        calendarReport.refetchEvents();
      });

      $('body').on('change', '#type-report', function() {
        var type = $('#type-report').val();
        var seach_term = $('#search-report').val();
        var page = $('#hidden_page_report').val();
        var only_me = $('#only_me-report:checked').val();

        fetch_data_report(page, type, seach_term, only_me);
        calendarReport.refetchEvents();
      });

      $('body').on('click', '#pagination-report a', function(event) {
        event.preventDefault();

        var page = $(this).attr('href').split('page=')[1];
        $('#hidden_page').val(page);

        var type = $('#type-report').val();
        var seach_term = $('#search-report').val();
        var only_me = $('#only_me:checked').val();

        fetch_data_report(page, type, seach_term, only_me);
      });

      $("input[name='only_me-report']").change(function() {
        if (this.checked) {
          @if (!Auth::check())
            alert("Silahkan masuk ke akun Anda terlebih dahulu.");
            window.location = "{{ route('login') }}";
          @endif
        }

        var type = $('#type-report').val();
        var seach_term = $('#search-report').val();
        var page = $('#hidden_page').val();
        var only_me = $('#only_me:checked').val();

        fetch_data_report(page, type, seach_term, only_me);
        calendarReport.refetchEvents();
      });

      $('#my-laporan-tab').on('click', function() {
        calendarReport.refetchEvents();
      });

      var calendarReportEl = document.getElementById("kt_docs_fullcalendar_report");
      var calendarReport = new FullCalendar.Calendar(calendarReportEl, {
        headerToolbar: {
          left: "prev,next today",
          center: "title",
          right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
        },

        height: 760,
        contentHeight: 700,
        // aspectRatio: 3, // see: https://fullcalendar.io/docs/aspectRatio

        nowIndicator: true,
        now: TODAY,

        views: {
          dayGridMonth: {
            buttonText: "month"
          },
          timeGridWeek: {
            buttonText: "week"
          },
          timeGridDay: {
            buttonText: "day"
          }
        },

        initialView: "dayGridMonth",
        initialDate: TODAY,

        editable: false,
        dayMaxEvents: true, // allow "more" link when too many events
        navLinks: true,
        displayEventTime: false,
        selectable: true,
        events: {
          url: "{{ route('website.status.report.calendar') }}",
          method: 'GET',
          extraParams: function() {
            /*
              Here we will grab the values of each of our filter input
              These will then be sent to the server
            */

            var only_me = $('#only_me-report:checked').val();
            if (only_me === undefined) {
              only_me = "";
            }

            return {
              type: $('[name="type-report"]').val(),
              search: $('[name="search-report"]').val(),
              only_me: only_me
            };
          }
        },
        eventContent: function(info) {
          var element = $(info.el);

          if (info.event.extendedProps && info.event.extendedProps.description) {
            if (element.hasClass("fc-day-grid-event")) {
              element.data("content", info.event.extendedProps.description);
              element.data("placement", "top");
              KTApp.initPopover(element);
            } else if (element.hasClass("fc-time-grid-event")) {
              element.find(".fc-title").append("<div class='fc-description'>" + info.event.extendedProps
                .description + "</div>");
            } else if (element.find(".fc-list-item-title").lenght !== 0) {
              element.find(".fc-list-item-title").append("<div class='fc-description'>" + info.event
                .extendedProps.description + "</div>");
            }
          }
        },
        eventClick: function(info) {
          var redirect_url = "{{ route('website.report.show', ':id') }}"
          window.location = redirect_url.replace(':id', info.event.id)
        }
      });
      calendarReport.render();
    });
  </script>
@endsection
