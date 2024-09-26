@extends('layout.efacility.master')

@section('styles')
  <link rel="stylesheet" href="{{ asset('demo1/plugins/custom/datatables/datatables.bundle.css') }}" />
  <style>
    .table td,
    .table th {
      padding: 6px;
    }
  </style>
@endsection

@section('content')
  <!-- ================================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          START FORM AREA
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      ================================= -->
  <section class="cart-area section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 mx-auto">
          <div class="listing-header pb-4">
            <h3 class="title font-size-28 pb-2">Pemeliharaan / Perawatan</h3>
          </div>
          <div class="form-box">
            <div class="form-title-wrap">
              <h3 class="title"><i class="la la-building-o mr-2 text-gray"></i>Form Izin Pemeliharaan / Perawatan</h3>
            </div><!-- form-title-wrap -->
            <div class="form-content contact-form-action">
              <div class="alert alert-danger label-text" role="alert" style="display: none">
                A simple danger alert—check it out!
              </div>
              <form method="post" class="row" id="form-repair" enctype="multipart/form-data">
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
                  <label class="label-text">Unit</label>
                    <div class="form-group">
                      <select id="unit" name="unit" class="form-control w-100">
                            <!-- Check if the user is authenticated -->
                        @if(Auth::check())
                            <!-- Set default value based on Auth::user()->itb_unit -->
                            <option value="{{ Auth::user()->itb_unit ?: '' }}">{{ Auth::user()->itb_unit ?: '' }}</option>
                        @else
                            <!-- Default option for not logged in users -->
                            <option value=""></option>
                        @endif
                        <option value="" disabled selected>Pilih Unit</option>
                        <option value="Badan Pengelola Usaha dan Dana Lestari">Badan Pengelola Usaha dan Dana Lestari</option>
                        <option value="Biro Administrasi Umum dan Informasi">Biro Administrasi Umum dan Informasi</option>
                        <option value="Biro Kemitraan">Biro Kemitraan</option>
                        <option value="Biro Komunikasi dan Hubungan Masyarakat">Biro Komunikasi dan Hubungan Masyarakat</option>
                        <option value="Direktorat Administrasi Umum">Direktorat Administrasi Umum</option>
                        <option value="Direktorat Eksekutif Pengelolaan Penerimaan Mahasiswa dan Kerjasama Pendidikan">Direktorat Eksekutif Pengelolaan Penerimaan Mahasiswa dan Kerjasama Pendidikan</option>
                        <option value="Direktorat Hubungan Masyarakat dan Alumni">Direktorat Hubungan Masyarakat dan Alumni</option>
                        <option value="Direktorat ITB Kampus Cirebon">Direktorat ITB Kampus Cirebon</option>
                        <option value="Direktorat ITB Kampus Jakarta">Direktorat ITB Kampus Jakarta</option>
                        <option value="Direktorat ITB Kampus Jatinangor">Direktorat ITB Kampus Jatinangor</option>
                        <option value="Direktorat Kawasan Sains dan Teknologi">Direktorat Kawasan Sains dan Teknologi</option>
                        <option value="Direktorat Kemahasiswaan">Direktorat Kemahasiswaan</option>
                        <option value="Direktorat Kemitraan & Hubungan Internasional">Direktorat Kemitraan & Hubungan Internasional</option>
                        <option value="Direktorat Kepegawaian">Direktorat Kepegawaian</option>
                        <option value="Direktorat Keuangan">Direktorat Keuangan</option>
                        <option value="Direktorat Logistik">Direktorat Logistik</option>
                        <option value="Direktorat Pendidikan Non Reguler">Direktorat Pendidikan Non Reguler</option>
                        <option value="Direktorat Pendidikan">Direktorat Pendidikan</option>
                        <option value="Direktorat Penerapan Ilmu dan Teknologi Multidisiplin">Direktorat Penerapan Ilmu dan Teknologi Multidisiplin</option>
                        <option value="Direktorat Pengembangan Pendidikan">Direktorat Pengembangan Pendidikan</option>
                        <option value="Direktorat Pengembangan">Direktorat Pengembangan</option>
                        <option value="Direktorat Perencanaan Sumberdaya">Direktorat Perencanaan Sumberdaya</option>
                        <option value="Direktorat Perencanaan">Direktorat Perencanaan</option>
                        <option value="Direktorat Sarana dan Prasarana">Direktorat Sarana dan Prasarana</option>
                        <option value="Direktorat Teknologi Informasi">Direktorat Teknologi Informasi</option>
                        <option value="Fakultas Ilmu dan Teknologi Kebumian">Fakultas Ilmu dan Teknologi Kebumian</option>
                        <option value="Fakultas Matematika dan Ilmu Pengetahuan Alam">Fakultas Matematika dan Ilmu Pengetahuan Alam</option>
                        <option value="Fakultas Seni Rupa dan Desain">Fakultas Seni Rupa dan Desain</option>
                        <option value="Fakultas Teknik Mesin dan Dirgantara">Fakultas Teknik Mesin dan Dirgantara</option>
                        <option value="Fakultas Teknik Pertambangan dan Perminyakan">Fakultas Teknik Pertambangan dan Perminyakan</option>
                        <option value="Fakultas Teknik Sipil dan Lingkungan">Fakultas Teknik Sipil dan Lingkungan</option>
                        <option value="Fakultas Teknologi Industri">Fakultas Teknologi Industri</option>
                        <option value="HaKI">HaKI</option>
                        <option value="Institut Teknologi Bandung">Institut Teknologi Bandung</option>
                        <option value="Kampus ITB">Kampus ITB</option>
                        <option value="Kantor Hukum">Kantor Hukum</option>
                        <option value="Kantor Kealumnian">Kantor Kealumnian</option>
                        <option value="Kantor Majelis Guru Besar">Kantor Majelis Guru Besar</option>
                        <option value="Kantor Satuan Kekayaan dan Dana">Kantor Satuan Kekayaan dan Dana</option>
                        <option value="Kantor WRAM">Kantor WRAM</option>
                        <option value="Kantor WRII">Kantor WRII</option>
                        <option value="Kantor WRSD">Kantor WRSD</option>
                        <option value="Kantor WRUK">Kantor WRUK</option>
                        <option value="Laboratorium Produksi Litbang Integrasi & Aplikasi ITB">Laboratorium Produksi Litbang Integrasi & Aplikasi ITB</option>
                        <option value="Lembaga Bimbingan Konseling">Lembaga Bimbingan Konseling</option>
                        <option value="Lembaga Kemahasiswaan">Lembaga Kemahasiswaan</option>
                        <option value="Lembaga Layanan Hukum">Lembaga Layanan Hukum</option>
                        <option value="Direktorat Riset dan Pengabdian Kepada Masyarakat">Direktorat Riset dan Pengabdian Kepada Masyarakat</option>
                        <option value="Majelis Wali Amanat">Majelis Wali Amanat</option>
                        <option value="Program Tahap Persiapan Bersama">Program Tahap Persiapan Bersama</option>
                        <option value="Pusat Ilmu Hayati">Pusat Ilmu Hayati</option>
                        <option value="Pusat Infrastruktur Data Spasial">Pusat Infrastruktur Data Spasial</option>
                        <option value="Pusat Kebijakan Keenergian">Pusat Kebijakan Keenergian</option>
                        <option value="Pusat Kebijakan Publik dan Kepemerintahan">Pusat Kebijakan Publik dan Kepemerintahan</option>
                        <option value="Pusat Lingkungan Hidup">Pusat Lingkungan Hidup</option>
                        <option value="Pusat Mikroelektronika">Pusat Mikroelektronika</option>
                        <option value="Pusat Mitigasi Bencana">Pusat Mitigasi Bencana</option>
                        <option value="Pusat Pangan, Kesehatan dan Obat-obatan">Pusat Pangan, Kesehatan dan Obat-obatan</option>
                        <option value="Pusat Pemberdayaan Perdesaan">Pusat Pemberdayaan Perdesaan</option>
                        <option value="Pusat Pemodelan Matematika dan Simulasi">Pusat Pemodelan Matematika dan Simulasi</option>
                        <option value="Pusat Pendayagunaan Open Source Software">Pusat Pendayagunaan Open Source Software</option>
                        <option value="Pusat Penelitian Bioteknologi">Pusat Penelitian Bioteknologi</option>
                        <option value="Pusat Penelitian dan Pengembangan">Pusat Penelitian dan Pengembangan</option>
                        <option value="Pusat Penelitian Nanosains dan Nanoteknologi">Pusat Penelitian Nanosains dan Nanoteknologi</option>
                        <option value="Pusat Penelitian Pengembangan Wilayah dan Infrastruktur">Pusat Penelitian Pengembangan Wilayah dan Infrastruktur</option>
                        <option value="Pusat Penelitian Produk Budaya dan Lingkungan">Pusat Penelitian Produk Budaya dan Lingkungan</option>
                        <option value="Pusat Penelitian Teknologi Informasi dan Komunikasi">Pusat Penelitian Teknologi Informasi dan Komunikasi</option>
                        <option value="Pusat Pengembangan Kawasan Pesisir dan Laut">Pusat Pengembangan Kawasan Pesisir dan Laut</option>
                        <option value="Pusat Pengembangan Sumberdaya Air">Pusat Pengembangan Sumberdaya Air</option>
                        <option value="Pusat Penginderaan Jauh">Pusat Penginderaan Jauh</option>
                        <option value="Pusat pengkajian Logistik dan Sistem Rantai Pasok">Pusat pengkajian Logistik dan Sistem Rantai Pasok</option>
                        <option value="Pusat Perencanaan dan Pengembangan Kepariwisataan">Pusat Perencanaan dan Pengembangan Kepariwisataan</option>
                        <option value="Pusat Perubahan Iklim">Pusat Perubahan Iklim</option>
                        <option value="Pusat Rekayasa Industri">Pusat Rekayasa Industri</option>
                        <option value="Pusat Studi Sarana dan Prasarana Tahan Gempa">Pusat Studi Sarana dan Prasarana Tahan Gempa</option>
                        <option value="Pusat Studi Sistem Tak Berawak">Pusat Studi Sistem Tak Berawak</option>
                        <option value="Pusat Teknologi Instrumentasi dan Otomasi">Pusat Teknologi Instrumentasi dan Otomasi</option>
                        <option value="Pusat Teknologi Kesehatan & Keolahragaan">Pusat Teknologi Kesehatan & Keolahragaan</option>
                        <option value="Satuan Pengawas Internal">Satuan Pengawas Internal</option>
                        <option value="Satuan Penjaminan Mutu">Satuan Penjaminan Mutu</option>
                        <option value="Satuan Usaha Komersial">Satuan Usaha Komersial</option>
                        <option value="Sekolah Arsitektur, Perencanaan dan Pengembangan Kebijakan">Sekolah Arsitektur, Perencanaan dan Pengembangan Kebijakan</option>
                        <option value="Sekolah Bisnis dan Manajemen">Sekolah Bisnis dan Manajemen</option>
                        <option value="Sekolah Farmasi">Sekolah Farmasi</option>
                        <option value="Sekolah Ilmu dan Teknologi Hayati">Sekolah Ilmu dan Teknologi Hayati</option>
                        <option value="Sekolah Pasca Sarjana">Sekolah Pasca Sarjana</option>
                        <option value="Sekolah Teknik Elektro dan Informatika">Sekolah Teknik Elektro dan Informatika</option>
                        <option value="Sekretariat Institut">Sekretariat Institut</option>
                        <option value="Unit Keamanan, Kesehatan dan Keselamatan Kerja dan Lingkungan">Unit Keamanan, Kesehatan dan Keselamatan Kerja dan Lingkungan</option>
                        <option value="Unit Pelaksana Teknis Asrama">Unit Pelaksana Teknis Asrama</option>
                        <option value="UPT Olahraga">UPT Olahraga</option>
                        <option value="UPT Pelayanan Kesehatan">UPT Pelayanan Kesehatan</option>
                        <option value="UPT Pengadaan">UPT Pengadaan</option>
                        <option value="UPT Pengembangan Manusia dan Organisasi">UPT Pengembangan Manusia dan Organisasi</option>
                        <option value="UPT Pengembangan SDM">UPT Pengembangan SDM</option>
                        <option value="UPT Perpustakaan">UPT Perpustakaan</option>
                        <option value="UPT Pusat Bahasa">UPT Pusat Bahasa</option>
                        <option value="UPT Saraga dan Sabuga">UPT Saraga dan Sabuga</option>
                      </select>
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
                          aria-describedby="basic-addon1" readonly required>
                      </div>
                    </div>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                  <div class="col-lg input-box">
                    <label class="label-text">Judul</label>
                    <div class="form-group">
                      <textarea class="form-control pl-3" rows="2" id="title" name="title" required></textarea>
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
                <div class="col-lg-6">
                  <div class="col-lg-8 input-box">
                    <label class="label-text">No Surat</label>
                    <div class="form-group">
                      <input type="text" class="form-control pl-3" id="nomor_surat" name="nomor_surat">
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
                  <div id="pengajuan-message" class="alert alert-danger" role="alert" style="display: none"></div>
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
              <button type="button" id="submitAjukanButton" class="btn btn-primary btn-small">Simpan Langsung
                Ajukan</button>
            </div>
            <div class="btn-box ml-3">
              <button type="button" id="submitDraftButton" class="btn btn-light btn-small">Simpan Sebagai
                Draft</button>
            </div>
            <ul class="list-items list--items ml-3 pt-1">
              <li><a href="{{ route('website.status') }}#my-laporan">Lihat Pengajuan Lainnya</a></li>
            </ul>
          </div><!-- end submit-box --><br>
          <div id="pengajuan-success" class="alert alert-success" role="alert" style="display: none"></div>
        </div><!-- end col-lg-10 -->
      </div><!-- end row -->
    </div><!-- end container -->
  </section><!-- end cart-area -->
  <!-- ================================
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          END FORM AREA
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      ================================= -->
@endsection

@section('scripts')
  <script src="{{ asset('demo1/plugins/custom/datatables/datatables.bundle.js') }}"></script>
  @include('website.repair._scripts-create')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script>
  $('#submitAjukanButton').click(function() {
      if ($('#pengajuan-message').is(":hidden")) {
          Swal.fire({
              icon: 'success',
              html: '<b>Form pengajuan telah berhasil disubmit, <br> Mohon tunggu sedang diproses.</b>',
              timer: 5000,
              showConfirmButton: false
          });
      }
  });

  $('#submitDraftButton').click(function() {
    if ($('#pengajuan-message').is(":hidden")) {
        Swal.fire({
            icon: 'success',
            html: '<b>Draft pengajuan telah berhasil disimpan, <br> Mohon tunggu sedang diproses.</b>',
            timer: 5000,
            showConfirmButton: false
        });
      }
  });
  </script>
@endsection

  <!-- Include jQuery (required for Select2) -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#unit').select2({
        placeholder: 'Pilih Unit',
        allowClear: true // Optional: Add a clear button
      });
    });
  </script>

