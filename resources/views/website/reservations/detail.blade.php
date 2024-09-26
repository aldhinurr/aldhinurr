@extends('layout.efacility.master')

@section('content')
  <!-- ================================
                                                                                                                                                                                                                                                                                                                                                                                                                                        START CART AREA
                                                                                                                                                                                                                                                                                                                                                                                                                                    ================================= -->
  <section class="cart-area section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="cart-wrap">
            <div class="listing-header pb-4">
              <h3 class="title font-size-28 pb-2">Status Layanan</h3>
            </div>
            <div class="table-form table-responsive mb-3">
              <div class="alert alert-danger label-text" role="alert" style="display: none">
                A simple danger alert—check it out!
              </div>
              <table class="table">
                <thead class="bg-primary">
                  <tr>
                    <th scope="col" class="text-white">Layanan</th>
                    <th scope="col" class="text-white text-center">Harga</th>
                    <th scope="col" class="text-white text-center">Biaya Tambahan</th>
                    <th scope="col" class="text-white text-center">Total</th>
                    <th scope="col" class="text-white text-center">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">
                      <div class="table-content product-content d-flex align-items-center">
                        <a href="{{ route('website.room.show', $reservation->layanan->id) }}" class="d-block">
                          @if ($reservation->layanan->layanan_gambars->count() > 0)
                            <img src="{{ asset($reservation->layanan->layanan_gambars->first()->picture) }}"
                              alt="" class="flex-shrink-0">
                          @else
                            <img src="" alt="Gambar Tidak Tersedia" class="flex-shrink-0">
                          @endif
                        </a>
                        <div class="product-content">
                          <a href="{{ route('website.room.show', $reservation->layanan->id) }}"
                            class="title">{{ $reservation->layanan->name }}</a>
                          <div class="product-info-wrap">
                          <div class="product-info line-height-24">
                              <span class="product-info-label">Kode Sewa:</span>
                              <span class="product-info-value">
                                <span
                                  class="product-info-value">{{ $reservation->kode_sewa }}</span>
                              </span>
                            </div><!-- end product-info -->
                            <div class="product-info line-height-24">
                              <span class="product-info-label">Unit Kerja:</span>
                              <span class="product-info-value">
                                <span
                                  class="product-check-in">{{ $reservation->unit }}</span>
                              </span>
                            </div>
                            <div class="product-info line-height-24">
                              <span class="product-info-label">Sewa:</span>
                              <span class="product-info-value">
                                <span
                                  class="product-check-in">{{ date('d-m-Y H:i', strtotime($reservation->start_date)) }}</span>
                                <span class="product-mark">s/d</span>
                                <span
                                  class="product-check-out">{{ date('d-m-Y H:i', strtotime($reservation->end_date)) }}</span>
                                {{-- <span class="product-nights">(1 night)</span> --}}
                              </span>
                            </div><!-- end product-info -->
                            <div class="product-info line-height-24">
                              <span class="product-info-label">Durasi Tarif Sewa:</span>
                              <span class="product-info-value">{{ $reservation->fee_for }}
                                {{ $reservation->layanan->price_for }}</span>
                            </div><!-- end product-info -->
                            <div class="product-info line-height-24">
                              <span class="product-info-label">Fasilitas Tambahan:</span>
                              <span class="product-info-value">
                                @if (count($extraFacilities) > 0)
                                  @foreach ($extraFacilities as $extraFacility)
                                    @php
                                      $facilities[] = $extraFacility->facility->name . ' ' . $extraFacility->quantity . ' ' . $extraFacility->facility->satuan;
                                    @endphp
                                  @endforeach
                                  {{ implode(', ', $facilities) }}
                                @else
                                  Tidak ada fasilitas tambahan
                                @endif
                              </span>
                            </div><!-- end product-info -->
                            <div class="product-info line-height-24">
                              <span class="product-info-label">Catatan:</span>
                              <span class="product-info-value">{{ $reservation->catatan }}</span>
                            </div><!-- end product-info -->
                            @if (strlen($reservation->description) > 0)
                              <div class="product-info line-height-24">
                                <span class="product-info-label">Keterangan:</span>
                                <span class="product-info-value">{{ $reservation->description }}</span>
                              </div><!-- end product-info -->
                            @endif
                            @if (strlen($reservation->new_layanan_id) > 0)
                              <div class="product-info line-height-24">
                                <span class="title">
                                  <a href="{{ route('website.reservation.show', $reservation->new_layanan_id) }}">
                                    Sewa dialihkan, klik disini untuk melihat detailnya.
                                  </a>
                                </span>
                              </div><!-- end product-info -->
                            @endif
                          </div>
                        </div>
                      </div>
                    </th>
                    <td>Rp. {{ number_format($reservation->fee, 2) }}</td>
                    <td>Rp. {{ number_format($reservation->extra_fee, 2) }}</td>
                    <td>Rp. {{ number_format($reservation->total, 2) }}</td>
                    <td class="text-center" width="60px">
                      @if ($reservation->status == 'MENUNGGU UPLOAD')
                        {{ __('Menunggu upload bukti pembayaran / pengalihan anggaran') }}
                      @elseif ($reservation->status == 'MENUNGGU REVIEW')
                        {{ __('Menunggu review oleh pihak pengelola') }}
                      @else
                        {{ $reservation->status }}
                      @endif
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="row">
              <div class="col-md-6"><br>
              @if ($reservation->total == 0)
              <button type="button" id="cancelButton" class="btn btn-outline-danger">Batalkan Reservasi</button>
              @else
              @if ($reservation->status != 'DIBATALKAN' && $reservation->status != 'MENUNGGU REVIEW' && $reservation->status != 'DISETUJUI')
                  <p>Silahkan transfer total pembayaran ke <strong>BNI Virtual Account </strong> di bawah:</p>
                  <h6>9880031157000800 (Bank Negara Indonesia Cabang ITB)</h6>
              @endif
                @if ($reservation->status == 'MENUNGGU UPLOAD')
                  <br>Batas waktu pembayaran: <span style="display: inline-block;"><h6 id="countdown-expired">0</h6></span>
                @endif
                @if (!auth()->user()->hasRole(['superadmin']))
                @if (auth()->user()->email == $reservation->created_by && $reservation->status != 'WAKTU HABIS' && $reservation->status != 'DIBATALKAN' && $reservation->status != 'DISETUJUI')
                  <hr><button type="button" id="cancelButton" class="btn btn-outline-danger">Batalkan Reservasi</button>
            </div>
            <div class="col-md-6">
                <div class="cart-actions d-flex justify-content-end align-items-center pt-4 pb-5">
                  <div id="form-upload" class="contact-form-action">
                   <!--  <form method="post" enctype="multipart/form-data" id="sumber-dana">
                      @csrf
                       <div class="form-container" style="font-weight: bold;">
                        <label for="sumberDana">Pilih Sumber Dana:</label>
                          <select id="sumberDana" name="sumberDana">
                            <option value="" disabled selected>~ Pilih ~</option>
                            <option value="pendanaanITB">Pendanaan ITB</option>
                            <option value="pendanaanNonITB">Pendanaan Non-ITB</option>
                          </select><br>
                          <button type="button" class="btn btn-primary" style="float: right;" id=submitDana>Submit</button>
                      </div> -->   
                    <strong>Nomor E-Office</strong>
                    <div class="d-flex">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <input type="text" class="form-control form-control-lg" id="eoffice" name="eoffice" value="{{ $reservation->no_eoffice }}">
                        <button class="btn btn-primary ml-2" type="button" id="eoffice-button">Kirim</button>
                    </div>
                    @if ($reservation->status != 'MENUNGGU REVIEW')
                    <br>
                    <form method="post" enctype="multipart/form-data" id="upload-receipt">  
                      @csrf
                      <strong>Upload Bukti Pembayaran</strong>
                      <div class="input-group d-flex justify-content-end">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="receipt" name="receipt"
                            aria-describedby="receipt">
                          <label class="custom-file-label" for="receipt">Pilih File...</label>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between pt-2">
                      @if($reservation->receipt)
                        <ul class="list-items list--items ml-2 pt-2">
                          <li><a href="{{ asset($reservation->receipt) }}" target="_blank">
                            Download Bukti Pembayaran</a></li>
                        </ul>
                      @endif
                        <button class="btn btn-primary" type="button" id="uploadButton">Upload</button>
                      </div>
                    </form>
                    @endif
                    <!--
                    <br>
                    <strong>Upload Surat Permohonan</strong>
                    <form method="post" enctype="multipart/form-data" id="surat_permohonan">  
                      @csrf
                      <div class="input-group d-flex justify-content-end">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="surat_permohonan" name="surat_permohonan"
                            aria-describedby="surat_permohonan">
                          <label class="custom-file-label" for="surat_permohonan">Pilih File...</label>
                        </div>
                      </div>
                      <div class="d-flex justify-content-between pt-2">
                      @if($reservation->surat_permohonan)
                        <ul class="list-items list--items ml-2 pt-2">
                          <li><a href="{{ asset($reservation->surat_permohonan) }}" target="_blank">
                            Download Surat Permohonan</a></li>
                        </ul>
                      @endif
                        <button class="btn btn-primary" type="button" id="uploadButton2">Upload</button>
                      </div>
                    </form> -->
                  </div>
                  <!-- end contact-form-action -->
                </div>
              @endif
             @endif
            @endif
          </div>
          </div><!-- end cart-wrap -->
        </div><!-- end col-lg-12 -->
      </div><!-- end row -->
    </div><!-- end container -->
  </section><!-- end cart-area -->
  <!-- ================================
                                                                                                                                                                                                                                                                                                                                                                                                                                        END CART AREA
                                                                                                                                                                                                                                                                                                                                                                                                                                    ================================= -->
@endsection

@section('scripts')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script>
      var cancelButton = document.getElementById('cancelButton');

      cancelButton.addEventListener('click', function(e) {
          e.preventDefault();

          (async () => {
              const { value: text } = await Swal.fire({
                  input: 'textarea',
                  inputLabel: 'Yakin akan membatalkan reservasi ini?',
                  inputPlaceholder: 'Isi alasan pembatalan..',
                  inputAttributes: {
                      'aria-label': 'Isi alasan pembatalan..'
                  },
                  icon: "warning",
                  showCancelButton: true,
                  buttonsStyling: false,
                  confirmButtonText: "Ok",
                  cancelButtonText: "Tutup",
                  reverseButtons: true,
                  customClass: {
                      cancelButton: "btn fw-bold btn-primary mr-2", 
                      confirmButton: "btn fw-bold btn-danger",
                  },
                  inputValidator: (value) => {
                      if (!value) {
                          return 'Silahkan isi alasan pembatalan.'
                      }
                  }
              });

              if (text) {
                  var url = "{{ route('reservation.cancel', $reservation->id) }}";
                  var data = {
                      'description': text
                  };

                  // Send ajax request
                  axios.post(url, data)
                      .then(function(response) {
                          // Show message popup
                          Swal.fire({
                              icon: "success",
                              text: response.data.message,
                              buttonsStyling: false,
                              confirmButtonText: "Ok",
                              customClass: {
                                  confirmButton: "btn btn-primary"
                              }
                          }).then(function(result) {
                              if (result.isConfirmed) {
                                  window.location = "/"
                              }
                          });
                      })
                      .catch(function(error) {
                          let dataMessage = error.response.data.message;
                          let dataErrors = error.response.data.errors;

                          for (const errorsKey in dataErrors) {
                              if (!dataErrors.hasOwnProperty(errorsKey)) continue;
                              dataMessage += "\r\n" + dataErrors[errorsKey];
                          }

                          if (error.response) {
                              Swal.fire({
                                  text: dataMessage,
                                  icon: "error",
                                  buttonsStyling: false,
                                  confirmButtonText: "Ok, got it!",
                                  customClass: {
                                      confirmButton: "btn btn-primary"
                                  }
                              });
                          }
                      });
              }
          })();
      });

    function hide(elements) {
      elements = elements.length ? elements : [elements];
      for (var index = 0; index < elements.length; index++) {
        elements[index].style.display = 'none';
      }
    }

    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    // Set the date we're counting down to
    var countDownDate = new Date("{{ $reservation->expired_payment }}").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

      // Get today's date and time
      var now = new Date().getTime();

      // Find the distance between now and the count down date
      var distance = countDownDate - now;

      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Display the result in the element with id="demo"
      document.getElementById("countdown-expired").innerHTML = " " + days + " Hari " + hours + " Jam " + minutes +
        " Menit " + seconds + " detik";

      // If the count down is finished, write some text
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("countdown-expired").innerHTML = "EXPIRED";
        hide(document.getElementById("form-upload"));
      }
    }, 1000);

    // UPLOAD BUKTI PEMBAYARAN ----------------------------------------------------
    $('#uploadButton').click(function() {
      try {
        var form = $('form')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
        var url = "{{ route('website.reservation.receipt.upload', ':id') }}";
        url = url.replace(':id', "{{ $reservation->id }}");

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
            $('.alert').html(response.message).fadeIn().delay(3000).fadeOut()
            window.location = "{{ route('website.reservation.show', $reservation->id) }}"
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
    });

    // UPLOAD SURAT PERMOHONAN ------------------------------------------------
    $('#uploadButton2').click(function() {
  try {
    var form = $('form')[1]; // You need to use standard javascript object here
        var formData = new FormData(form);
        var url = "{{ route('website.reservation.permohonan.upload', ':id') }}";
        url = url.replace(':id', "{{ $reservation->id }}");

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
            $('.alert').html(response.message).fadeIn().delay(3000).fadeOut()
            window.location = "{{ route('website.reservation.show', $reservation->id) }}"
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
    });

  document.getElementById('eoffice-button').addEventListener('click', function () {
      // Get the eoffice input value
      var eofficeValue = document.getElementById('eoffice').value;
      
      // Get the reservation ID, assuming it's available in your view
      var reservationId = '{{ $reservation->id }}';
      
      // Prepare the AJAX request
      fetch(`/reservation/${reservationId}/store-eoffice`, {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({
              eoffice: eofficeValue
          })
      })
      .then(response => response.json())
      .then(data => {
          if (data.message) {
              // Display success message using SweetAlert
              Swal.fire({
                  icon: 'success',
                  title: 'Success',
                  text: data.message,
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'OK'
              }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.reload();
                  }
              });
          }
      })
      .catch(error => console.error('Error:', error));
  });

    //SELECTED BOX SUMBER DANA ----------------------------------------------
    // document.addEventListener("DOMContentLoaded", function () {
    //         const submitButton = document.getElementById("submitDana");
    //         const sumberDanaComboBox = document.getElementById("sumberDana");

    //         submitButton.addEventListener("click", function () {
    //             const selectedValue = sumberDanaComboBox.value;

    //             if (selectedValue === "pendanaanITB") {
    //                 alert("Pendanaan ITB masih dalam pengembangan.");
    //             } else if (selectedValue === "pendanaanNonITB") {
    //                 alert("Pendanaan Non-ITB masih dalam pengembangan.");
    //             } else {
    //                 alert("Silakan pilih sumber dana terlebih dahulu.");
    //             }
    //         });
    //     });
  </script>
@endsection
