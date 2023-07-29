@extends('layout.efacility.master')

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
                          <input type="checkbox" id="catChb1">
                          <label for="catChb1">
                            <h3 class="title font-size-16 pt-1">Saya</h3>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="filter-option">
                      <div class="select-contain">
                        <select id="type" name="type" class="select-contain-select">
                          <option value="RUANG">Ruangan</option>
                          <option value="KENDARAAN">Kendaraan</option>
                        </select>
                      </div><!-- end select-contain -->
                    </div>
                    <div class="filter-option">
                      <div class="contact-form-action">
                        <div class="form-group mb-0">
                          <input class="form-control" type="text" name="search" placeholder="Cari"
                            style="padding-left: 20px">
                          <button class="search-btn"><i class="la la-search"></i></button>
                        </div>
                      </div>
                    </div>
                  </div><!-- end filter-bar-filter -->
                  <div class="layout-view d-flex align-items-center">
                    <a href="hotel-grid.html" data-toggle="tooltip" data-placement="top" title="Tabel" class="active"><i
                        class="la la-th-list"></i></a>
                    <a href="hotel-list.html" data-toggle="tooltip" data-placement="top" title="Kalender"><i
                        class="la la-calendar"></i></a>
                  </div>
                </div><!-- end filter-bar -->
              </div><!-- end filter-wrap -->

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
                      <tbody id="status-data">
                        @include('website.status._data')
                      </tbody>
                    </table>
                  </div>
                </div>
              </div><!-- end form-box -->
            </div><!-- end tab-pane -->
            <div class="tab-pane fade" id="my-laporan" role="tabpanel" aria-labelledby="my-laporan-tab">
              <div class="filter-wrap margin-bottom-30px">
                <div class="filter-bar d-flex align-items-center justify-content-between">
                  <div class="filter-bar-filter d-flex flex-wrap align-items-center">
                    <div class="filter-option">
                      <div class="checkbox-wrap pt-1 px-3">
                        <div class="custom-checkbox">
                          <input type="checkbox" id="catChb1">
                          <label for="catChb1">
                            <h3 class="title font-size-16 pt-1">Saya</h3>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="filter-option">
                      <h3 class="title font-size-16">Layanan</h3>
                    </div>
                    <div class="filter-option">
                      <div class="select-contain" style="width: 210px; margin-right: 20px">
                        <select class="select-contain-select">
                          <option value="RUANG">Peminjaman Ruangan</option>
                          <option value="Kendaraan">Peminjaman Kendaraan</option>
                        </select>
                      </div><!-- end select-contain -->
                    </div>
                    <div class="filter-option">
                      <div class="contact-form-action" style="width: 210px">
                        <div class="form-group mb-0">
                          <input class="form-control" type="text" name="text" placeholder="Cari"
                            style="padding-left: 20px">
                          <button class="search-btn"><i class="la la-search"></i></button>
                        </div>
                      </div>
                    </div>
                  </div><!-- end filter-bar-filter -->
                  <div class="layout-view d-flex align-items-center">
                    <a href="hotel-grid.html" data-toggle="tooltip" data-placement="top" title="Tabel"
                      class="active"><i class="la la-th-list"></i></a>
                    <a href="hotel-list.html" data-toggle="tooltip" data-placement="top" title="Kalender"><i
                        class="la la-calendar"></i></a>
                  </div>
                </div><!-- end filter-bar -->
              </div><!-- end filter-wrap -->

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
                      @include('website.status._data')
                    </table>
                  </div>
                </div>
              </div><!-- end form-box -->
              @if ($sewa->isNotEmpty())
                <nav aria-label="Page navigation example">
                  <ul class="pagination">
                    <li class="page-item">
                      @if ($sewa->onFirstPage())
                        <a class="page-link page-link-nav disabled" aria-label="Previous">
                          <span aria-hidden="true"><i class="la la-angle-left"></i></span>
                          <span class="sr-only">Previous</span>
                        </a>
                      @else
                        <a class="page-link page-link-nav" href="{{ $sewa->previousPageUrl() }}" aria-label="Previous">
                          <span aria-hidden="true"><i class="la la-angle-left"></i></span>
                          <span class="sr-only">Previous</span>
                        </a>
                      @endif
                    </li>
                    <li class="page-item active">
                      <a class="page-link page-link-nav" href="#">{{ $sewa->currentPage() }}<span
                          class="sr-only">(current)</span></a>
                    </li>
                    <li class="page-item">
                      @if ($sewa->hasMorePages())
                        <a class="page-link page-link-nav" href="{{ $sewa->nextPageUrl() }}" aria-label="Next">
                          <span aria-hidden="true"><i class="la la-angle-right"></i></span>
                          <span class="sr-only">Next</span>
                        </a>
                      @else
                        <a class="page-link page-link-nav disabled" aria-label="Next">
                          <span aria-hidden="true"><i class="la la-angle-right"></i></span>
                          <span class="sr-only">Next</span>
                        </a>
                      @endif
                    </li>
                  </ul>
                </nav>
              @endif
            </div><!-- end tab-pane -->
          </div>
        </div><!-- end col-lg-9 -->
      </div><!-- end row -->
    </div><!-- end container -->
  </section><!-- end card-area -->
@endsection

@section('scripts')
  <script>
    $(document).ready(function() {
      const fetch_data = (page, type, seach_term) => {
        if (page === undefined) {
          page = 1;
        }

        if (type === undefined) {
          type = "";
        }

        if (seach_term === undefined) {
          seach_term = "";
        }

        var url = "{{ route('website.status') }}?page=" + page + "&type=" + type + "&seach_term=" + seach_term
        $.ajax({
          url: url,
          success: function(data) {
            $('tbody').html('');
            $('tbody').html(data);
          }
        })
      }

      $('body').on('keyup', '#search', function() {
        var status = $('#status').val();
        var seach_term = $('#search').val();
        var page = $('#hidden_page').val();
        fetch_data(page, status, seach_term);
      });

      $('body').on('change', '#type', function() {
        var type = $('#type').val();
        var seach_term = $('#search').val();
        var page = $('#hidden_page').val();
        fetch_data(page, type, seach_term);
      });

      $('body').on('click', '#pagination-sewa a', function(event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        $('#hidden_page').val(page);
        var type = $('#type').val();
        var seach_term = $('#search').val();
        fetch_data(page, type, seach_term);
      });
    });
  </script>
@endsection
