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

  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html((fileName != '') ? fileName :
      'Pilih File...');
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
      "width": "3%"
    }, {
      "targets": [5, 6],
      "render": function(data, type, full, meta) {
        return "<div style='width: 150px; white-space:normal;'>" + data + "</div>";
      }
    }, {
      "targets": [7],
      "render": $.fn.dataTable.render.number(',', '.', 0, 'Rp. '),
    }, {
      "targets": [8],
      "className": 'dt-center'
    }]
  });

  var total = 0;
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
        "cost": parseFloat(cost.replaceAll(",", ""))
      }

      // add to detail
      if (detail.hasOwnProperty(floor_id)) {
        detail[floor_id].data.push(childRowData)
        detail[floor_id].total += parseFloat(cost.replaceAll(",", ""))
      } else {
        detail[floor_id] = {
          number: parseInt(number),
          total: parseFloat(cost.replaceAll(",", "")),
          data: [childRowData]
        };
      }

      var isExist = detailTable.columns(1).search(floor_id).data()[0];
      if (isExist.includes(floor_id)) {
        var rowIndex = isExist.indexOf(floor_id)
        var rowAdd = detailTable.row(rowIndex);

        // update total
        detailTable.cell({
          row: rowIndex,
          column: 7
        }).data(detail[floor_id].total).draw(false);
      } else {
        var rowAdd = detailTable.row.add([
          building_id,
          floor_id,
          number,
          gedung['text'],
          lantai['number'],
          lantai['floor_classification'] + " " + lantai['room_classification'],
          lantai['room_description'],
          cost.replaceAll(",", ""),
          `<span onclick="javascript:deleteRow('${floor_id}')"><i class="la la-trash text-danger"></i></span>`
        ]).draw(false)

        number += 1
      }

      // update child
      rowAdd.child(formatSubRow(floor_id)).show();

      // update total
      hitungTotal();

      // after add
      $("#building_id").empty();
      $("#floor_id").empty();
      $("#name").val('');
      $("#cost").val('');
    } catch (error) {
      console.log(error);
      $('#pengajuan-message').html('Data pengajuan belum lengkap atau dipilih!').fadeIn().delay(3000).fadeOut();
    }
  });

  function formatSubRow(id) {
    var child = [];
    var childDetail = detail[id];
    childDetail.data.forEach((e, idx) => {
      child.push(`<div id='${id}_${idx}' class="col-lg-12">
          <div class="row">
            <div class="px-3">${childDetail.number}.${idx + 1}</div>
            <div class="col-lg-9 mr-1">${e.name}</div>
            <div class="col-lg-2 pl-2 pr-0" style="max-width:15%">Rp. ${parseFloat(e.cost, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString()}</div>
            <span onclick="javascript:deleteChildRow('${id}_${idx}')"><i class="la la-trash text-danger"></i></span>
          </div>
      </div>`);
    });
    return child.join("\n");
  }

  function deleteRow(id) {
    // remove table row
    var rows = detailTable.columns(1).search(id).data()[0];
    var rowIndex = rows.indexOf(id)
    var row = detailTable.row(rowIndex);
    row.remove().draw(false);

    // remove data
    delete detail[id];

    // update total
    hitungTotal();
    number -= 1;
  }

  function deleteChildRow(id) {
    var element = document.getElementById(id);
    var ids = id.split("_")
    var rowData = detail[ids[0]]
    var childRowData = rowData.data[ids[1]]

    // update detail
    rowData.total -= childRowData['cost'];
    rowData.data.splice(ids[1], 1);

    // update table row
    var rows = detailTable.columns(1).search(ids[0]).data()[0];
    var rowIndex = rows.indexOf(ids[0])
    detailTable.cell({
      row: rowIndex,
      column: 7
    }).data(rowData.total).draw(false);

    // remove element
    element.remove();

    // update total
    hitungTotal();
  }

  function hitungTotal() {
    var cost = 0;
    console.log(detail);
    if (Object.keys(detail)) {
      Object.keys(detail).forEach(id => {
        var fee = detail[id].total;
        cost += fee;
      })
    }
    total = cost;
    $('#total').val(parseFloat(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,").toString())
  }

  var form = document.getElementById('form-repair');
  var submitAjukanButton = document.getElementById('submitAjukanButton');
  submitAjukanButton.addEventListener('click', function(e) {
    e.preventDefault();
    submitRepair("Ajukan", submitAjukanButton);
  });

  var submitDraftButton = document.getElementById('submitDraftButton');
  submitDraftButton.addEventListener('click', function(e) {
    e.preventDefault();
    submitRepair("Draft", submitDraftButton);
  });

  function submitRepair(status, button) {
    try {
      var data = new FormData(form);
      data.set('status', status);
      data.set('total', $("#total").val().replace(/[^0-9\.-]+/g, ""));
      data.append('pengajuan_detail', JSON.stringify(detail))

      // Display the key/value pairs
      for (var pair of data.entries()) {
        console.log(pair[0] + ', ' + pair[1]);
        if (pair[0] == "unit" && pair[1] == "") {
          $('#pengajuan-message').html('Unit belum diisi.').fadeIn().delay(3000).fadeOut();
          $('#unit').focus();
          return
        }

        if (pair[0] == "title" && pair[1] == "") {
          $('#pengajuan-message').html('Judul belum diisi.').fadeIn().delay(3000).fadeOut();
          $('#title').focus();
          return
        }

        if (pair[0] == "pengajuan_detail" && pair[1] == "{}") {
          $('#pengajuan-message').html('Detail perbaikan belum ditambahkan.').fadeIn().delay(3000).fadeOut();
          $('#building_id').focus();
          return
        }
      }

      // Disable button to avoid multiple click
      button.disabled = true;

      // Send ajax request
      $.ajax({
        url: "{{ route('website.repair.store') }}",
        type: 'POST',
        data: data,
        dataType: 'json',
        processData: false,
        contentType: false,
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        success: function(response) {
          setTimeout(function() {
            var redirect_url = "{{ route('website.repair.show', ':id') }}"
            window.location = redirect_url.replace(':id', response.repair_id)
          }, 5000);
        },
        error: function(xhr, ajaxOptions, thrownError) {
          var contentType = xhr.getResponseHeader("Content-Type");
          if (xhr.status == 401) {
            $('#pengajuan-message').html('Silahkan login terlebih dahulu untuk melanjutkan.').fadeIn().delay(
                3000)
              .fadeOut();
            setTimeout(function() {
              window.location = "{{ route('login-page') }}"
            }, 5000);
          } else {
            console.log(xhr.responseText);
            $('#pengajuan-message').html('Sistem sedang dalam pemeliharaan, silahkan coba beberapa saat lagi.')
              .fadeIn().delay(3000)
              .fadeOut();
            button.disabled = false;
          };
        }
      });
    } catch (error) {
      console.log(error);
      button.disabled = false;
      $('#pengajuan-message').html(error).fadeIn().delay(3000).fadeOut();
    }
  }
</script>