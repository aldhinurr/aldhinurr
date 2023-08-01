<script text="javascript">
  "use strict";
  // Class definition
  var KTAFacilityForms = function() {
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
            type: {
              validators: {
                notEmpty: {
                  message: 'Silahkan pilih Jenis Layanan'
                }
              }
            },
            name: {
              validators: {
                notEmpty: {
                  message: 'Nama Layanan belum diisi'
                }
              }
            },
            alamat: {
              validators: {
                notEmpty: {
                  message: 'Alamat belum diisi'
                }
              }
            },
            location: {
              validators: {
                notEmpty: {
                  message: 'Silahkan pilih Lokasi'
                }
              }
            },
            price: {
              validators: {
                notEmpty: {
                  message: 'Harga belum diisi'
                }
              }
            },
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

      // Select2 validation integration
      $(form.querySelector('[name="type"]')).on('change', function() {
        // Revalidate the color field when an option is chosen
        validation.revalidateField('type');
      });

      $(form.querySelector('[name="language"]')).on('change', function() {
        // Revalidate the color field when an option is chosen
        validation.revalidateField('language');
      });

      $(form.querySelector('[name="timezone"]')).on('change', function() {
        // Revalidate the color field when an option is chosen
        validation.revalidateField('timezone');
      });
    }

    var handleForm = function() {
      submitButton.addEventListener('click', function(e) {
        e.preventDefault();

        var data = new FormData(form);
        data.set('fee', form.querySelector("#fee").inputmask.unmaskedvalue());


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
                  text: "Fasilitas Berhasil Diubah",
                  icon: "success",
                  buttonsStyling: false,
                  confirmButtonText: "Ok",
                  customClass: {
                    confirmButton: "btn btn-primary"
                  }
                }).then(function(result) {
                  form.reset();
                  if (result.isConfirmed) {
                    window.location = "{{ route('facility.index') }}"
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
              text: "Sorry, looks like there are some errors detected, please try again.",
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
        form = document.getElementById('kt_facility_create_form');
        submitButton = form.querySelector('#kt_facility_create_submit');

        initValidation();
        handleForm();
      }
    }
  }();

  // On document ready
  KTUtil.onDOMContentLoaded(function() {
    KTAFacilityForms.init();
  });
</script>