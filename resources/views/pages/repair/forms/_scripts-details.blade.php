<script text="javascript">
  "use strict";
  // Class definition
  var KTARepairDetail = function() {
    // Private variables
    var approveButton;
    var rejectButton;
    var reviewButton;

    var handleForm = function() {

      approveButton.addEventListener('click', function(e) {
        e.preventDefault();

        Swal.fire({
          title: "Yakin akan mensetujui pengajuan ini?",
          icon: "info",
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
            var url = "{{ route('repair.approve', $repair->id) }}"
            var data = {
              'description': "Pengajuan Perbaikan Diterima."
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
                    window.location = "{{ route('repair.show', $repair->id) }}"
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
        });
      });

      rejectButton.addEventListener('click', function(e) {
        e.preventDefault();

        (async () => {
          const {
            value: text
          } = await Swal.fire({
            input: 'textarea',
            inputLabel: 'Yakin akan menolak pengajuan ini?',
            inputPlaceholder: 'Alasan ditolak',
            inputAttributes: {
              'aria-label': 'Alasan ditolak'
            },
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Ya",
            cancelButtonText: "Batal",
            reverseButtons: true,
            customClass: {
              cancelButton: "btn fw-bold btn-light",
              confirmButton: "btn fw-bold btn-danger",
            },
            inputValidator: (value) => {
              if (!value) {
                return 'Silahkan isi alasan ditolak.'
              }
            }
          })

          if (text) {
            var url = "{{ route('repair.reject', $repair->id) }}"
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
                    window.location = "{{ route('repair.show', $repair->id) }}"
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

      reviewButton.addEventListener('click', function(e) {
        e.preventDefault();

        Swal.fire({
          title: "Yakin akan menreview pengajuan ini?",
          icon: "info",
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
            var url = "{{ route('repair.review', $repair->id) }}"
            var data = {
              'description': "Pengajuan Perbaikan Direview."
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
                    window.location = "{{ route('repair.show', $repair->id) }}"
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
        });
      });
    }

    // Public methods
    return {
      init: function() {
        approveButton = document.getElementById('approveButton');
        rejectButton = document.getElementById('rejectButton');
        reviewButton = document.getElementById('reviewButton');
        handleForm();
      }
    }
  }();

  // On document ready
  KTUtil.onDOMContentLoaded(function() {
    KTARepairDetail.init();
  });
</script>