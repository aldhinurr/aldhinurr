<script text="javascript">
  "use strict";
  // Class definition
  var KTAReservationDetail = function() {
    // Private variables
    var approveButton;
    var rejectButton;


    var handleButton = function() {

      approveButton.addEventListener('click', function(e) {
        e.preventDefault();

        (async () => {
          const {
            value: text
          } = await Swal.fire({
            input: 'textarea',
            inputLabel: 'Yakin akan mensetujui sewa ini?',
            inputPlaceholder: 'Isi informasi persetujuan..',
            inputAttributes: {
              'aria-label': 'Isi informasi persetujuan..'
            },
            icon: "info",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Ok",
            cancelButtonText: "Batal",
            reverseButtons: true,
            customClass: {
              cancelButton: "btn fw-bold btn-danger",
              confirmButton: "btn fw-bold btn-primary",
            },
            inputValidator: (value) => {
              if (!value) {
                return 'Silahkan isi informasi persetujuan.'
              }
            }
          })

          if (text) {
            var url = "{{ route('report.approve', $report->id) }}"
            var data = {
              'description': text
            }

            // Send ajax request
            axios.post(url, data)
              .then(function(response) {
                // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
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
                    window.location = "{{ route('report.show', $report->id) }}"
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

      rejectButton.addEventListener('click', function(e) {
        e.preventDefault();

        (async () => {
          const {
            value: text
          } = await Swal.fire({
            input: 'textarea',
            inputLabel: 'Yakin akan membatalkan sewa ini?',
            inputPlaceholder: 'Isi informasi pembatalan..',
            inputAttributes: {
              'aria-label': 'Isi informasi pembatalan..'
            },
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Ok",
            cancelButtonText: "Batal",
            customClass: {
              cancelButton: "btn fw-bold btn-primary",
              confirmButton: "btn fw-bold btn-danger",
            },
            inputValidator: (value) => {
              if (!value) {
                return 'Silahkan isi informasi pembatalan.'
              }
            }
          })

          if (text) {
            var url = "{{ route('report.reject', $report->id) }}"
            var data = {
              'description': text
            }

            // Send ajax request
            axios.post(url, data)
              .then(function(response) {
                // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
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
                    window.location = "{{ route('report.show', $report->id) }}"
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
    }

    // Public methods
    return {
      init: function() {
        approveButton = document.getElementById('approveButton');
        rejectButton = document.getElementById('rejectButton');

        handleButton();
      }
    }
  }();

  // On document ready
  KTUtil.onDOMContentLoaded(function() {
    KTAReservationDetail.init();
  });
</script>