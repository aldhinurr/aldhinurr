@extends('layout.trizen.master')

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
                          <img src="{{ asset($reservation->layanan->layanan_gambars->first()->picture) }}" alt=""
                            class="flex-shrink-0">
                        </a>
                        <div class="product-content">
                          <a href="{{ route('website.room.show', $reservation->layanan->id) }}"
                            class="title">{{ $reservation->layanan->name }}</a>
                          <div class="product-info-wrap">
                            <div class="product-info line-height-24">
                              <span class="product-info-label">Sewa:</span>
                              <span class="product-info-value">
                                <span
                                  class="product-check-in">{{ date('d-m-Y', strtotime($reservation->start_date)) }}</span>
                                <span class="product-mark">/</span>
                                <span
                                  class="product-check-out">{{ date('d-m-Y', strtotime($reservation->end_date)) }}</span>
                                {{-- <span class="product-nights">(1 night)</span> --}}
                              </span>
                            </div><!-- end product-info -->
                            <div class="product-info line-height-24">
                              <span class="product-info-label">Durasi:</span>
                              <span class="product-info-value">{{ $reservation->fee_for }}
                                {{ $reservation->layanan->price_for }}</span>
                            </div><!-- end product-info -->
                            <div class="product-info line-height-24">
                              <span class="product-info-label">Fasilitas Tambahan:</span>
                              <span class="product-info-value">
                                @if (count($extraFacilities) > 0)
                                  @foreach ($extraFacilities as $extraFacility)
                                    @php
                                      $facilities[] = $extraFacility->facility->name . ' ' . $extraFacility->facility->fee_for . ' ' . $extraFacility->facility->satuan;
                                    @endphp
                                  @endforeach
                                  {{ implode(', ', $facilities) }}
                                @else
                                  Tidak ada fasilitas tambahan
                                @endif
                              </span>
                            </div><!-- end product-info -->
                            <div class="product-info line-height-24">
                              <span class="product-info-label">Keterangan:</span>
                              <span class="product-info-value">{{ $reservation->description }}</span>
                            </div><!-- end product-info -->
                          </div>
                        </div>
                      </div>
                    </th>
                    <td>Rp. {{ number_format($reservation->fee, 2) }}</td>
                    <td>Rp. {{ number_format($reservation->extra_fee, 2) }}</td>
                    <td>Rp. {{ number_format($reservation->total, 2) }}</td>
                    <td>{{ $reservation->status }}</td>
                  </tr>
                </tbody>
              </table>
              @if ($reservation->status == 'MENUNGGU UPLOAD')
                <div class="title d-flex justify-content-end align-items-center">
                  <p>Waktu tersisa:
                  <h6 id="countdown-expired">0</h6>
                  </p>
                </div>
              @endif
            </div>
            <div class="section-block"></div>
            <div class="cart-actions d-flex justify-content-end align-items-center pt-4 pb-5">
              <div class="contact-form-action">
                <form method="post" enctype="multipart/form-data" id="upload-receipt">
                  @csrf
                  <div class="input-group d-flex justify-content-end">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="receipt" name="receipt"
                        aria-describedby="receipt">
                      <label class="custom-file-label" for="receipt">Pilih File...</label>
                    </div>
                  </div>
                  <div class="d-flex justify-content-between pt-2">
                    <ul class="list-items list--items ml-2 pt-2">
                      <li><a href="{{ asset($reservation->receipt) }}">Download Bukti Pembayaran</a></li>
                    </ul>
                    <button class="btn btn-primary" type="button" id="uploadButton">Upload</button>
                  </div>
                </form>
              </div><!-- end contact-form-action -->
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
  <script>
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
      document.getElementById("countdown-expired").innerHTML = " " + hours + " Jam " +
        minutes + " Menit " + seconds + " detik";

      // If the count down is finished, write some text
      if (distance < 0) {
        clearInterval(x);
        document.getElementById("countdown-expired").innerHTML = "EXPIRED";
      }
    }, 1000);

    // upload receipt
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
            await new Promise(r => setTimeout(r, 4000));
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
  </script>
@endsection
