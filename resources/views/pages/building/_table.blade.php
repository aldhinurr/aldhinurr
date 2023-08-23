<!--begin::Table-->
{{ $dataTable->table(['class' => 'table table-row-bordered gy-5']) }}
<!--end::Table-->

{{-- Inject Scripts --}}
@section('scripts')
  {{ $dataTable->scripts() }}

  <script type="text/javascript">
    var handleDeleteRows = () => {
      var deleteMenuItems = document.getElementsByClassName('delete_menu_item');
      deleteMenuItems.forEach(deleteButton => {
        deleteButton.addEventListener('click', function(e) {
          e.preventDefault();

          const dt = window.LaravelDataTables["facility-table"]
          const parent = e.target.closest('tr');
          var data_row = dt.row(parent).data();

          Swal.fire({
            html: "Apakah yakin data ingin dihapus <strong>" + data_row['name'] + "</strong>?",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Ya",
            cancelButtonText: "Batal",
            reverseButtons: true,
            customClass: {
              confirmButton: "btn fw-bold btn-danger",
              cancelButton: "btn fw-bold btn-primary"
            }
          }).then(function(result) {
            if (result.isConfirmed) {
              Swal.fire({
                text: "Proses hapus " + data_row['name'] + "...",
                icon: "info",
                buttonsStyling: false,
                showConfirmButton: false,
                timer: 5000
              }).then(function() {
                // Send ajax request
                axios.delete("{{ route('facility.delete', ':id') }}".replace(':id', data_row[
                    'id']))
                  .then(function(response) {
                    Swal.fire({
                      html: "Facility <strong>" + data_row['name'] +
                        "</strong> berhasil dihapus.",
                      icon: "success",
                      buttonsStyling: false,
                      confirmButtonText: "Ok",
                      customClass: {
                        confirmButton: "btn btn-primary"
                      }
                    }).then(function(result) {
                      if (result.isConfirmed) {
                        dt.ajax.reload(null, false);
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
                        confirmButtonText: "Ok",
                        customClass: {
                          confirmButton: "btn btn-primary"
                        }
                      });
                    }
                  });
              });
            }
          });
        });
      });
    }
  </script>
@endsection
