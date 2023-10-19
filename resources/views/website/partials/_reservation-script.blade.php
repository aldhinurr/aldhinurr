<script type="text/javascript">
  var fee = "{{ $data->price }}";
  var totalFee;
  var addFee = 0;
  var total = 0;
  var is_sewa = 0;

  (function($) {
    "use strict";
    var $window = $(window);
    var form;
    var submitButton;
    var fasilitasButton;

    var handleForm = function() {
      $('[name="daterange-single"]').daterangepicker({
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
        opens: "right",
        // startDate: moment().add(3, "day"),
        // minDate: moment().add(3, "day"),
        startDate: moment('2024-01-01', 'YYYY-MM-DD'),
        minDate: moment('2024-01-01', 'YYYY-MM-DD'),
        locale: {
          format: "DD/MM/YYYY HH:mm",
        },
      });

      $('#start_date').on('apply.daterangepicker', (e, picker) => {
        var start = moment(picker.startDate.format('YYYY-MM-DD'));
        var end = moment($('#end_date').val(), 'DD/MM/YYYY');
        var duration = moment.duration(end.diff(start));
        var days = duration.asDays() + 1;

        if (days < 0) {
          $('.alert').html('Tanggal Mulai lebih dari Tanggal Akhir!').fadeIn().delay(3000).fadeOut();
          is_sewa = 1;
          return
        }

        $('#duration').val(days);
        sumFeeReservation();
        checkReservation();
      });

      $('#end_date').on('apply.daterangepicker', (e, picker) => {
        var start = moment($('#start_date').val(), 'DD/MM/YYYY');
        var end = moment(picker.endDate.format('YYYY-MM-DD'));
        var duration = moment.duration(end.diff(start));
        var days = duration.asDays() + 1;

        if (days < 0) {
          $('.alert').html('Tanggal Akhir kurang dari Tanggal Mulai!').fadeIn().delay(3000).fadeOut();
          is_sewa = 1;
          return
        }

        $('#duration').val(days);
        sumFeeReservation();
        checkReservation();
      });

      $('#fasilitas').select2({
        theme: 'bootstrap',
        placeholder: 'Pilih Fasilitas',
        ajax: {
          url: "{{ route('website.facilities') }}",
          dataType: 'json',
          delay: 250,
          data: function(params) {
            return {
              search: params.term,
              data_id: "{{ $data->id }}",
            }
          },
          processResults: function(data, page) {
            return {
              results: data
            };
          },
          error: function(jqXHR, status, error) {
            console.log(error);
          }
        },
      });

      fasilitasButton.addEventListener("click", function(e) {
        e.preventDefault();

        var days = $('#duration').val();
        var fasilitas = $('#fasilitas').select2('data')['0'];
        var fasilitasFee = parseFloat(days) * parseFloat(fasilitas['fee']);
        var feeFasilitasHtml = `
          <div class="custom-checkbox">
            <input type="hidden" class="extra-fee" value="${fasilitas['id']}" id="facility_${fasilitas['id']}" data-fee="${fasilitasFee}" />
            <label for="cleaningChb" class="d-flex justify-content-between align-items-center">
              ${fasilitas['name']} (${fasilitas['fee_for']} ${fasilitas['satuan']})<span onclick="javascript:removeFacility('facility_${fasilitas['id']}')" class="text-black font-weight-regular delete-facility">
              Rp. ${parseFloat(fasilitasFee, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString()}<i class="la la-trash form-icon text-danger"></i></span></label>
          </div>
        `

        $('#info-extra-service').remove();
        $('#extraServiceList').append(feeFasilitasHtml);

        // hitung total
        addFee = addFee + parseInt(fasilitasFee);
        sumFeeReservation();

        $('#fasilitas').empty();
      })

      submitButton.addEventListener('click', function(e) {
        e.preventDefault();

        // validate is_sewa        
        if (is_sewa > 0) {
          $('.alert').html('Sewa gagal, silahkan pilih tanggal lain.').fadeIn().delay(3000)
            .fadeOut();
          return
        }

        var data = {}
        data["layanan_id"] = "{{ $data->id }}";
        data["start_date"] = $("#start_date").val();
        data["end_date"] = $("#end_date").val();
        data["catatan"] = $("#catatan").val();
        data["fee"] = $("#fee").val().replace(/[^0-9\.-]+/g, "");
        data["fee_for"] = $("#duration").val();
        data["total"] = $("#total").val().replace(/[^0-9\.-]+/g, "");

        // add extra fee
        var extra_fee = 0
        var extraServiceList = document.querySelectorAll('#extraServiceList input');
        if (extraServiceList.length > 0) {
          const extra_fee_detail = []
          for (let idx = 0; idx < extraServiceList.length; idx++) {
            const facility_id = extraServiceList[idx].getAttribute("value");
            const fee = extraServiceList[idx].getAttribute("data-fee");
            extra_fee_detail.push({
              "facility_id": facility_id,
              "fee": fee,
            })
            extra_fee += parseFloat(fee);
          }
          data['extra_fee_detail'] = extra_fee_detail;
        }
        data['extra_fee'] = extra_fee;

        // Disable button to avoid multiple click
        submitButton.disabled = true;

        // Send ajax request
        $.ajax({
          url: "{{ route('website.reservation') }}",
          type: 'POST',
          data: data,
          dataType: 'json',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          success: function(response) {
            var redirect_url = "{{ route('website.reservation.show', ':id') }}"
            window.location = redirect_url.replace(':id', response.reservation_id)
          },
          error: function(xhr, ajaxOptions, thrownError) {
            var contentType = xhr.getResponseHeader("Content-Type");
            if (xhr.status == 401) {
              $([document.documentElement, document.body]).animate({
                scrollTop: $("#is_available").offset().top - 200
              }, 2000);
              $('.alert').html('Silahkan login terlebih dahulu untuk melanjutkan.').fadeIn().delay(3000)
                .fadeOut();
              setTimeout(function() {
                window.location = "{{ route('login-page') }}"
              }, 5000);
            } else {
              console.log(xhr.responseText);
              alert(xhr.responseText)
            };
          }
        })
      });
    }

    $window.on("load", function() {
      var $document = $(document);
      form = document.getElementById('sewa');
      submitButton = document.getElementById('submit-sewa');
      fasilitasButton = document.getElementById('add-fasilitas');

      handleForm();
      checkReservation();
      sumFeeReservation();
    });
  })(jQuery);

  function checkReservation() {
    var endpoint = "{{ route('website.reservation.check') }}"
    var layanan = "{{ $data->id }}"
    var date = $('#start_date').val()
    var availableInfo = $('#is_available');

    // Send ajax request
    $.ajax({
      url: endpoint + "?layanan=" + layanan + "&date=" + date,
      type: 'GET',
      success: function(response) {
        is_sewa = response;
        availableInfo.empty();
        if (response > 0) {
          availableInfo.html(`<span class="badge badge-secondary text-white">Sedang Disewa</span>`)
        } else {
          availableInfo.html(`<span class="badge badge-success text-white">Tersedia</span>`)
        }
      },
      error: function(xhr, ajaxOptions, thrownError) {
        var contentType = xhr.getResponseHeader("Content-Type");
        if (xhr.status === 200 && contentType.toLowerCase().indexOf("text/html") >= 0) {
          window.location.reload();
        } else {
          alert(xhr.responseText)
        };
      }
    })
  }

  function sumFeeReservation() {
    var duration = $('#duration').val();
    totalFee = parseInt(fee) * parseInt(duration);
    total = totalFee + addFee;

    $('#fee').val(parseFloat(totalFee, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
    $('#total').val(parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString());
  }

  function removeFacility(id) {
    var element = document.getElementById(id);
    var feeElement = element.getAttribute("data-fee");

    // update total
    addFee = addFee - parseInt(feeElement)
    sumFeeReservation();

    // remove data
    element.parentElement.remove();

    if ($('#extraServiceList').html() == '') {
      var infoHtml = `<label for="info-extra-service" id="info-extra-service">Tidak ada fasilitas tambahan.</label>`
      $('#extraServiceList').append(infoHtml);
    }
  }
</script>