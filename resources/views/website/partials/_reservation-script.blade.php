<script type="text/javascript">
  var fee = "{{ $data->price }}";
  var totalFee;
  var addFee = 0;
  var total = 0;

  (function($) {
    "use strict";
    var $window = $(window);
    var form;
    var submitButton;
    var fasilitasButton;

    var handleForm = function() {
      $('#start_date').on('apply.daterangepicker', (e, picker) => {
        console.log(picker);
        var start = moment(picker.startDate.format('YYYY-MM-DD'));
        var end = moment($('#end_date').val(), 'DD/MM/YYYY');
        var duration = moment.duration(end.diff(start));
        var days = duration.asDays() + 1;

        if (days < 0) {
          $('.alert').html('Tanggal Mulai lebih dari Tanggal Akhir!').fadeIn().delay(3000).fadeOut();
          return
        }

        $('#duration').val(days);
        sumFeeReservation();
      });

      $('#end_date').on('apply.daterangepicker', (e, picker) => {
        var start = moment($('#start_date').val(), 'DD/MM/YYYY');
        var end = moment(picker.endDate.format('YYYY-MM-DD'));
        var duration = moment.duration(end.diff(start));
        var days = duration.asDays() + 1;

        if (days < 0) {
          $('.alert').html('Tanggal Akhir kurang dari Tanggal Mulai!').fadeIn().delay(3000).fadeOut();
          return
        }

        $('#duration').val(days);
        sumFeeReservation();
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

      function remove(id) {
        alert(id);
      }

      fasilitasButton.addEventListener("click", function(e) {
        e.preventDefault();

        var fasilitas = $('#fasilitas').select2('data')['0'];
        var feeFasilitasHtml = `
          <div class="custom-checkbox">
            <input type="hidden" class="extra-fee" value="${fasilitas['id']}" id="facility_${fasilitas['id']}" data-fee="${fasilitas['fee']}" />
            <label for="cleaningChb" class="d-flex justify-content-between align-items-center">
              ${fasilitas['name']} (${fasilitas['fee_for']} ${fasilitas['satuan']})<span onclick="javascript:removeFacility('facility_${fasilitas['id']}')" class="text-black font-weight-regular delete-facility">Rp. ${fasilitas['fee']}<i class="la la-trash form-icon text-danger"></i></span></label>
          </div>
        `

        $('#info-extra-service').remove();
        $('#extraServiceList').append(feeFasilitasHtml);

        // hitung total
        addFee = addFee + parseInt(fasilitas['fee']);
        sumFeeReservation();

        $('#fasilitas').empty();
      })

      submitButton.addEventListener('click', function(e) {
        e.preventDefault();

        var data = {}
        data["layanan_id"] = "{{ $data->id }}";
        data["start_date"] = $("#start_date").val();
        data["end_date"] = $("#end_date").val();
        data["fee"] = $("#fee").val();
        data["fee_for"] = $("#duration").val();
        data["total"] = $("#total").val();

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
            if (xhr.status === 200 && contentType.toLowerCase().indexOf("text/html") >= 0) {
              // assume that our login has expired - reload our current page
              window.location.reload();
            } else {
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
    });
  })(jQuery);

  function sumFeeReservation() {
    var duration = $('#duration').val();
    totalFee = parseInt(fee) * parseInt(duration);
    total = totalFee + addFee;

    $('#fee').val(totalFee);
    $('#total').val(total);
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
