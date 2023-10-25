<script text="javascript">
  "use strict";
  // Class definition
  var KTABuildingForms = function() {
    // Private variables
    var form;
    var submitButton;
    var validation;

    // Private functions
    var initValidation = function() {
      // Init form validation rules. For more info check the FormValidation plugin's official documentation: https://formvalidation.io/
      validation = FormValidation.formValidation(
        form, {
          fields: {
            number: {
              validators: {
                notEmpty: {
                  message: 'Lantai belum diisi'
                }
              }
            },
            // floor_classification: {
            //   validators: {
            //     notEmpty: {
            //       message: 'Klasifikasi Ruangan belum diisi'
            //     }
            //   }
            // },
            // room_classification: {
            //   validators: {
            //     notEmpty: {
            //       message: 'Klasifikasi Ruangan belum diisi'
            //     }
            //   }
            // },
            // room_description: {
            //   validators: {
            //     notEmpty: {
            //       message: 'Uraian Ruangan belum diisi'
            //     }
            //   }
            // },
            // large: {
            //   validators: {
            //     notEmpty: {
            //       message: 'Luas belum diisi'
            //     }
            //   }
            // },
          },
          plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap: new FormValidation.plugins.Bootstrap5({
              rowSelector: '.fv-row',
              eleInvalidClass: '',
              eleValidClass: ''
            })
          }
        }
      );
    }

    var handleForm = function() {
      submitButton.addEventListener('click', function(e) {
        e.preventDefault();

        var data = new FormData(form);

        // Validate form
        validation.validate().then(function(status) {
          if (status === 'Valid') {
            // Show loading indication
            submitButton.setAttribute('data-kt-indicator', 'on');

            // Disable button to avoid multiple click
            submitButton.disabled = true;

            // Send ajax request
            axios.post(submitButton.closest('form').getAttribute('action'), data)
              .then(function(response) {
                // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                Swal.fire({
                  text: "Lantai & Ruang Berhasil Diubah",
                  icon: "success",
                  buttonsStyling: false,
                  confirmButtonText: "Ok",
                  customClass: {
                    confirmButton: "btn btn-primary"
                  }
                }).then(function(result) {
                  form.reset();
                  if (result.isConfirmed) {
                    var redirect_url = "{{ route('building.floors', ':id') }}"
                    window.location = redirect_url.replace(':id', "{{ $floor->building_id }}")
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
              })
              .then(function() {
                // always executed
                // Hide loading indication
                submitButton.removeAttribute('data-kt-indicator');

                // Enable button
                submitButton.disabled = false;
              });
          } else {
            // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
            Swal.fire({
              text: "Terjadi kesalahan, silahkan cek kembali.",
              icon: "error",
              buttonsStyling: false,
              confirmButtonText: "Ok, got it!",
              customClass: {
                confirmButton: "btn btn-primary"
              }
            });
          }
        });
      });
    }

    // Public methods
    return {
      init: function() {
        form = document.getElementById('kt_floor_create_form');
        submitButton = form.querySelector('#kt_floor_create_submit');

        initValidation();
        handleForm();
      }
    }
  }();

  // On document ready
  KTUtil.onDOMContentLoaded(function() {
    KTABuildingForms.init();
  });
</script>