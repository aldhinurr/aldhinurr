@extends('layout.efacility.master')

@section('styles')
  <link rel="stylesheet" href="{{ asset('demo1/plugins/custom/datatables/datatables.bundle.css') }}" />
@endsection

@section('content')
  <!-- ================================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                      START FORM AREA
                                                                                                                                                                                                                                                                                                                                                                                                                                                                  ================================= -->
  <section class="listing-form section--padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 mx-auto">
          <div class="listing-header pb-4">
            <h3 class="title font-size-28 pb-2">Perbaikan</h3>
          </div>
          <div class="form-box">
            <div class="form-title-wrap">
              <h3 class="title"><i class="la la-building-o mr-2 text-gray"></i>Form Pengajuan Perbaikan</h3>
            </div><!-- form-title-wrap -->
            <div class="form-content contact-form-action">
              <div class="alert alert-danger label-text" role="alert" style="display: none">
                A simple danger alert—check it out!
              </div>
              <form method="post" class="row" id="form-report" enctype="multipart/form-data">
                @csrf
                <div class="col-lg-6">
                  <div class="col-lg-8 input-box">
                    <label class="label-text">Tanggal</label>
                    <div class="form-group">
                      <input type="text" class="form-control pl-3" id="created_at" name="created_at"
                        value="{{ date('d-m-Y') }}" readonly>
                    </div>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                  <div class="col-lg-8 input-box">
                    <label class="label-text">Status</label>
                    <div class="form-group">
                      <input type="text" class="form-control pl-3" id="status" name="status" value="Baru"
                        readonly>
                    </div>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                  <div class="col-lg-8 input-box">
                    <label class="label-text">Unit Kerja</label>
                    <div class="form-group">
                      <input type="text" class="form-control pl-3" id="unit" name="unit">
                    </div>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                  <div class="col-lg-8 input-box">
                    <label class="label-text">Total</label>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text label-text" id="basic-addon1">Rp</span>
                        </div>
                        <input type="text" class="form-control pl-3" id="total" name="total" value="0"
                          aria-describedby="basic-addon1" readonly>
                      </div>
                    </div>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                  <div class="col-lg input-box">
                    <label class="label-text">Judul</label>
                    <div class="form-group">
                      <textarea class="form-control pl-3" rows="2" id="title" name="title"></textarea>
                    </div>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                  <div class="col-lg-8 input-box">
                    <label class="label-text">Attachment</label>
                    <div class="form-group">
                      <div class="input-group d-flex justify-content-end">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="attachment" name="attachment"
                            aria-describedby="attachment">
                          <label class="custom-file-label label-text" for="attachment">Pilih File...</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-12 pt-3 pb-3">
                  <div class="col-lg-8 input-box">
                    <h6 class="text-black">Detil Pengajuan Perbaikan</h6>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                  <div class="col-lg input-box">
                    <label class="label-text">Gedung</label>
                    <div class="form-group">
                      <select id="building_id" name="building_id" class="form-control w-100"></select>
                    </div>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                  <div class="col-lg input-box">
                    <label class="label-text">Lantai & Ruang</label>
                    <div class="form-group">
                      <select id="floor_id" name="floor_id" class="form-control w-100"></select>
                    </div>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                  <div class="col-lg input-box">
                    <label class="label-text">Pekerjaan</label>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-small pl-3" id="name"
                        name="name">
                    </div>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-4">
                  <div class="col-lg input-box">
                    <label class="label-text">Biaya</label>
                    <div class="form-group">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text label-text" id="basic-addon1">Rp</span>
                          </div>
                          <input type="text" class="form-control form-control-small pl-3" id="cost"
                            name="cost" aria-describedby="basic-addon1">
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-12">
                  <div class="col-lg mb-3">
                    <div class="btn-box">
                      <button type="button" id="addButton" class="theme-btn theme-btn-small">Tambah</button>
                    </div>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-12">
                  <div id="pengajuan-message" class="alert alert-danger" role="alert" hidden></div>
                  <div class="table-responsive">
                    <table class="table table-row-dashed" id="detail-pengajuan" cellspacing="0" width="100%"
                      style="font-size:12px;">
                      <thead>
                        <tr>
                          <th>#IDGedung</th>
                          <th>#IDLantai</th>
                          <th>No</th>
                          <th>Gedung</th>
                          <th>Lantai</th>
                          <th>Klasifikasi Ruangan</th>
                          <th>Uraian Ruangan</th>
                          <th>Total</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </form>
            </div><!-- end form-content -->
          </div><!-- end form-box -->
          <div class="row submit-box ml-1">
            <div class="btn-box">
              <button type="button" id="submitButton" class="theme-btn theme-btn-small">Simpan <i
                  class="la la-arrow-right ml-1"></i></button>
            </div>
            <ul class="list-items list--items ml-3 pt-1">
              <li><a href="{{ route('website.status') }}#my-laporan">Lihat Laporan Lainnya</a></li>
            </ul>
          </div><!-- end submit-box -->
        </div><!-- end col-lg-9 -->
      </div><!-- end row -->
    </div><!-- end container -->
  </section><!-- end listing-form -->
  <!-- ================================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                      END FORM AREA
                                                                                                                                                                                                                                                                                                                                                                                                                                                                  ================================= -->
@endsection

@section('scripts')
  <script src="{{ asset('demo1/plugins/custom/datatables/datatables.bundle.js') }}"></script>
  @include('website.repair._scripts-create')
@endsection
