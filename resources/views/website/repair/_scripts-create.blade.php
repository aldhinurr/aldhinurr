<script type="text/javascript">
  $('#building_id').select2({
    theme: 'bootstrap',
    placeholder: 'Pilih Gedung',
    ajax: {
      url: "{{ route('website.buildings') }}",
      dataType: 'json',
      delay: 250,
      data: function(params) {
        return {
          search: params.term,
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

  $('#floor_id').select2({
    theme: 'bootstrap',
    placeholder: 'Pilih Lantai',
    ajax: {
      url: "{{ route('website.floors') }}",
      dataType: 'json',
      delay: 250,
      data: function(params) {
        return {
          search: params.term,
          building_id: $('#building_id').val(),
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

  $("#cost").on('keyup', function() {
    if (this.value == '') {
      this.value = 0;
    }
    var n = parseInt($(this).val().replace(/\D/g, ''), 10);
    $(this).val(n.toLocaleString('en'));
  });

  // init datatable
  var detailTable = $('#detail-pengajuan').DataTable({
    'paging': false,
    'searching': false,
    'lengthChange': false,
    'bInfo': false,
    "columnDefs": [{
      "targets": [0, 1],
      "visible": false,
    }, {
      "targets": [2, 4, 8],
      "width": "5%"
    }, {
      "targets": [5, 6],
      "render": function(data, type, full, meta) {
        return "<div style='width: 150px; white-space:normal;'>" + data + "</div>";
      }
    }]
  });

  var number = 1;
  var detail = {};
  var addButton = document.getElementById('addButton');
  addButton.addEventListener('click', function(e) {
    e.preventDefault();

    try {
      var gedung = $('#building_id').select2('data')['0'];
      var lantai = $('#floor_id').select2('data')['0'];
      var building_id = gedung['id'];
      var floor_id = lantai['id'];
      var name = ($("#name").val() != "") ? $("#name").val() : exit();
      var cost = ($("#cost").val() != "") ? $("#cost").val() : exit();

      var childRowData = {
        "name": name,
        "cost": cost
      }

      var isExist = detailTable.columns(1).search(floor_id).data()[0];
      if (isExist.includes(floor_id)) {
        var rowAdd = detailTable.row({
          search: floor_id
        });
        console.log(rowAdd);
        rowAdd.child(formatSubRow(childRowData)).show();
      } else {
        // add to table
        var rowAdd = detailTable.row.add([
          building_id,
          floor_id,
          number,
          gedung['text'],
          lantai['number'],
          lantai['floor_classification'] + " " + lantai['room_classification'],
          lantai['room_description'],
          cost,
          `<span><i class="la la-trash form-icon text-danger"></i></span>`
        ]).draw(false)
        console.log(rowAdd);

        // add subrow
        childRowData = {
          "name": name,
          "cost": cost
        }
        rowAdd.child(formatSubRow(childRowData)).show();
      }

      // after add
    } catch (error) {
      console.log(error);
      $('#pengajuan-message').html('Data Anggaran belum lengkap atau dipilih!').fadeIn().delay(3000).fadeOut();
    }
  });

  function formatSubRow(data) {
    return '<td>' + data["name"] + '</td>' +
      '<td>' + data["cost"] + '</td>';
  }
  s


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