@extends('layout.trizen.master')

@section('content')
  <!-- ================================
                                                                                                                START FORM AREA
                                                                                                            ================================= -->
  <section class="listing-form section--padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-9 mx-auto">
          <div class="listing-header pb-4">
            <h3 class="title font-size-28 pb-2">Laporan</h3>
          </div>
          <div class="form-box">
            <div class="form-title-wrap">
              <h3 class="title"><i class="la la-building-o mr-2 text-gray"></i>Detail Laporan</h3>
            </div><!-- form-title-wrap -->
            <div class="form-content contact-form-action">
              <div class="alert alert-danger label-text" role="alert" style="display: none">
                A simple danger alert—check it out!
              </div>
              <form method="post" class="row" id="form-report" enctype="multipart/form-data">
                @csrf
                <div class="col-lg-12">
                  <div class="input-box">
                    <label class="label-text">Tanggal</label>
                    <div class="form-group">
                      <span class="title">{{ date('d-m-Y') }}</span>
                    </div>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                  <div class="input-box">
                    <label class="label-text">Jenis Laporan</label>
                    <div class="form-group select-contain w-100">
                      <select id="jenis" name="jenis" class="select-contain-select">
                        <option value="">--Jenis Laporan--</option>
                        <option value="Laporan Kerusakan">Laporan Kerusakan</option>
                        <option value="Laporan Kebersihan">Laporan Kebersihan</option>
                        <option value="Laporan Keamanan<">Laporan Keamanan</option>
                      </select>
                    </div>
                  </div>
                </div><!-- end col-lg-6 -->
                <div class="col-lg-12">
                  <div class="input-box">
                    <label class="label-text mb-0 line-height-20">Keterangan</label>
                    <p class="font-size-13 mb-3 line-height-20">Maksimal 200 karakter</p>
                    <div class="form-group">
                      <span class="la la-pencil form-icon"></span>
                      <textarea class="message-control form-control" id="keterangan" name="keterangan"
                        placeholder="Informasikan detil laporan..."></textarea>
                    </div>
                  </div>
                </div><!-- end col-lg-12 -->
                <div class="col-lg-12">
                  <label class="label-text mb-0 line-height-20">Upload atau Pilih Gambar</label>
                  <p class="font-size-13 mb-3 line-height-20">Maksimal 10 Gambar.</p>
                  <div class="file-upload-wrap">
                    <input type="file" id="files" name="files[]"
                      accept="image/png, image/gif, image/jpeg, image/jpg" class="multi file-upload-input with-preview"
                      multiple maxlength="10">
                    <span class="file-upload-text"><i class="la la-upload mr-2"></i>Klik or drag disini untuk
                      upload</span>
                  </div>
                </div><!-- end col-lg-12 -->
              </form>
            </div><!-- end form-content -->
          </div><!-- end form-box -->
          <div class="submit-box">
            <div class="btn-box">
              <button type="button" id="submitButton" class="theme-btn">Simpan <i
                  class="la la-arrow-right ml-1"></i></button>
            </div>
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
  <script src="{{ asset('trizen/js/jquery.multi-file.min.js') }}"></script>
  <script>
    var submitButton = document.getElementById('submitButton');
    submitButton.addEventListener('click', function(e) {
      e.preventDefault();

      try {
        var form = $('#form-report')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        var url = "{{ route('website.report.store') }}";

        // Send ajax request
        $.ajax({
          url: url,
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          success: function(response) {
            $('.alert').removeClass('alert-danger')
            $('.alert').addClass('alert-success')
            $('.alert').html(response.message).fadeIn().delay(3000).fadeOut();

            var redirect_url = "{{ route('website.report.show', ':id') }}"
            window.location = redirect_url.replace(':id', response.report_service_id)
          },
          error: function(xhr, ajaxOptions, thrownError) {
            var contentType = xhr.getResponseHeader("Content-Type");
            if (xhr.status === 200 && contentType.toLowerCase().indexOf("text/html") >= 0) {
              // assume that our login has expired - reload our current page
              window.location.reload();
            } else {
              $('.alert').addClass('alert-danger')
              $('.alert').html(xhr.responseText).fadeIn().delay(3000).fadeOut()
            };
          }
        });
      } catch (error) {
        $('.alert').addClass('alert-danger')
        $('.alert').html(error).fadeIn().delay(3000).fadeOut()
      }
    })
  </script>
@endsection
