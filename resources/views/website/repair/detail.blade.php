@extends('layout.efacility.master')

@section('content')
  <!-- ================================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            START CART AREA
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ================================= -->
  <section class="cart-area section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 mx-auto">
          <div class="listing-header pb-4">
            <h3 class="title font-size-28 pb-2">Status Layanan</h3>
          </div>
          <div class="form-box">
            <div class="d-flex form-title-wrap justify-content-between">
              <h3 class="title"><i class="la la-building-o mr-2 text-gray"></i>Pengajuan Perbaikan</h3>
              <a href="{{ route('website.status') }}#my-perbaikan" class="btn btn-sm btn-primary">{{ __('Kembali') }}</a>
            </div><!-- form-title-wrap -->
            <div class="form-content contact-form-action">
              <form method="post" class="row" id="form-repair" enctype="multipart/form-data">
                <div class="col-lg-6">
                  <div class="col-lg-8 input-box">
                    <label class="label-text">Tanggal</label>
                    <div class="form-group">
                      <input type="text" class="form-control-plaintext pl-3" id="created_at" name="created_at"
                        value="{{ date('d-m-Y H:i', strtotime($repairService->created_at)) }}">
                    </div>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                  <div class="col-lg-8 input-box">
                    <label class="label-text">Status</label>
                    <div class="form-group">
                      <input type="text" class="form-control-plaintext pl-3" id="status" name="status"
                        value="{{ $repairService->status }}">
                    </div>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                  <div class="col-lg-8 input-box">
                    <label class="label-text">Unit Kerja</label>
                    <div class="form-group">
                      <input type="text" class="form-control-plaintext pl-3" id="unit" name="unit"
                        value="{{ $repairService->unit }}">
                    </div>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                  <div class="col-lg-8 input-box">
                    <label class="label-text">Total</label>
                    <div class="form-group">
                      <input type="text" class="form-control-plaintext pl-3" id="total" name="total"
                        value="Rp. {{ number_format($repairService->total, 2) }}">
                    </div>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                  <div class="col-lg input-box">
                    <label class="label-text">Judul</label>
                    <div class="form-group">
                      <textarea class="form-control-plaintext pl-3" rows="2" id="title" name="title">{!! $repairService->title !!}</textarea>
                    </div>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                  <div class="col-lg-8 input-box">
                    <label class="label-text">Attachment</label>
                    <div class="form-group">
                      @if ($repairService->attachment != null)
                        <ul class="list-items list--items pl-3">
                          <li><a href="{{ asset($repairService->attachment) }}" target="_blank">Download attachment</a>
                          </li>
                        </ul>
                      @else
                        Tidak ada.
                      @endif
                    </div>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                  <div class="col-lg input-box">
                    <label class="label-text">Nomor Surat</label>
                    <div class="form-group">
                      <input type="text" class="form-control-plaintext pl-3" id="nomor_surat" name="nomor_surat"
                        value="{{ $repairService->nomor_surat }}">
                    </div>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-12 pt-3 pb-3">
                  <div class="col-lg-8 input-box">
                    <h6 class="text-black">Detil Pengajuan Perbaikan</h6>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-12">
                  <div class="table-responsive">
                    <table class="table table-row-dashed" id="detail-pengajuan" cellspacing="0" width="100%"
                      style="font-size:12px;">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Gedung</th>
                          <th>Lantai</th>
                          <th>Klasifikasi Ruangan</th>
                          <th>Uraian Ruangan</th>
                          <th>Total</th>
                        </tr>
                      </thead>
                      <tbody class="text-gray-600">
                        @php
                          $number = 1;
                        @endphp
                        @foreach ($repairServiceDetails as $detail)
                          <tr>
                            <td>{{ $number }}</td>
                            <td>{{ $detail['building'] }}</td>
                            <td class="text-center">{{ $detail['floor'] }}</td>
                            <td>{{ $detail['classification'] }}</td>
                            <td>{{ $detail['description'] }}</td>
                            <td>Rp. {{ number_format($detail['total'], 2) }}</td>
                          </tr>
                          @foreach ($detail['data'] as $work)
                            <tr>
                              <td>{{ $number }}.{{ $loop->index + 1 }}</td>
                              <td colspan="4">
                                <div class="text-muted">{{ $work['name'] }}</div>
                              </td>
                              <td>Rp. {{ number_format($work['cost'], 2) }}</td>
                            </tr>
                          @endforeach
                          @php
                            $number++;
                          @endphp
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </form>
            </div><!-- end form-content -->
          </div><!-- end form-box -->
        </div><!-- end col-lg-10 -->
      </div><!-- end row -->
    </div><!-- end container -->
  </section><!-- end cart-area -->
  <!-- ================================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            END CART AREA
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ================================= -->
@endsection
