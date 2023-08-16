<script text="javascript">
  "use strict";
  // Class definition
  var KTAModalAlihkanLayanan = function() {
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
            new_layanan_id: {
              validators: {
                notEmpty: {
                  message: 'Silahkan pilih Layanan'
                }
              }
            },
            description: {
              validators: {
                notEmpty: {
                  message: 'Keterangan belum diisi'
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
    }

    var handleForm = function() {
      const optionFormat = (item) => {
        if (!item.id) {
          return item.text;
        }

        var span = document.createElement('span');
        var template = '';

        template += '<div class="d-flex align-items-center">';
        template += '<img src="{{ URL::to("/"); }}/' + item.images + '" class="h-40px me-3" alt="' + item.text + '"/>';
        template += '<div class="d-flex flex-column">'
        template += '<span class="fs-4 fw-bold lh-1">' + item.text + '</span>';
        template += '<span class="text-muted fs-5">' + item.address + '</span>';
        template += '<span class="text-muted fs-5">' + item.location + '</span>';
        template += '</div>';
        template += '</div>';

        span.innerHTML = template;

        return $(span);
      }

      $('[name="new_layanan_id"]').select2({
        templateSelection: optionFormat,
        templateResult: optionFormat,
        ajax: {
          url: "{{ route('layanan.find') }}",
          type: "post",
          dataType: 'json',
          delay: 250,
          data: function(params) {
            return {
              _token: '{{ csrf_token() }}',
              id: $("#old_layanan_id").val(),
              type: $("#old_layanan_type").val(),
              price: $("#old_layanan_price").val(),
              search: params.term,
            };
          },
          processResults: function(response) {
            return {
              results: response
            };
          },
          cache: true
        }
      });

      $('[name="new_layanan_id"]').on('select2:select', function(e) {
        var data = e.params.data;
        if (!parseInt(data.id) > 0) {
          $('[name="new_layanan_id"]').empty()
          return
        }
        $('[name="new_layanan_price"]').val(data.price)
      });

      $('#facility').repeater({
        initEmpty: false,

        defaultValues: {
          'text-input': 'foo'
        },

        show: function() {
          $(this).slideDown();

          // Re-init select2
          $(this).find('[data-kt-repeater="select2-facility"]').select2({
            ajax: {
              url: "{{ route('website.facilities') }}",
              dataType: 'json',
              delay: 250,
              data: function(params) {
                return {
                  data_id: $("#new_layanan_id").val(),
                  search: params.term // search term
                };
              },
              processResults: function(response) {
                return {
                  results: response
                };
              },
              cache: true
            }
          });

          var index = $(this).closest('[data-repeater-item]').index();
          $('[data-kt-repeater="select2-facility"]').on('select2:select', function(e) {
            var data = e.params.data;
            if (!parseInt(data.id) > 0) {
              $('[data-kt-repeater="select2-facility"]').empty()
              return
            }

            $('[name="facility[' + (index < 0 ? 0 : index) + '][facilty_fee]"]').val(data.fee)
            $('[name="facility[' + (index < 0 ? 0 : index) + '][facilty_fee_for]"]').val(data.fee_for)
          });

        },

        hide: function(deleteElement) {
          $(this).slideUp(deleteElement);
        },

        ready: function() {
          // Init select2
          $('[data-kt-repeater="select2-facility"]').select2({
            ajax: {
              url: "{{ route('website.facilities') }}",
              dataType: 'json',
              delay: 250,
              data: function(params) {
                return {
                  data_id: $("#new_layanan_id").val(),
                  search: params.term // search term
                };
              },
              processResults: function(response) {
                return {
                  results: response
                };
              },
              cache: true
            }
          });

          var index = $(this).closest('[data-repeater-item]').index();
          $('[data-kt-repeater="select2-facility"]').on('select2:select', function(e) {
            var data = e.params.data;
            if (!parseInt(data.id) > 0) {
              $('[data-kt-repeater="select2-facility"]').empty()
              return
            }
            $('[name="facility[' + (index < 0 ? 0 : index) + '][facilty_fee]"]').val(data.fee)
            $('[name="facility[' + (index < 0 ? 0 : index) + '][facilty_fee_for]"]').val(data.fee_for)
          });

        }
      });

      submitButton.addEventListener('click', function(e) {
        e.preventDefault();

        // assign value 
        var data = new FormData(form);
        data.append('facility', JSON.stringify($('#facility').repeaterVal()));

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
                  icon: "success",
                  text: response.data.message,
                  buttonsStyling: false,
                  confirmButtonText: "Ok",
                  customClass: {
                    confirmButton: "btn btn-primary"
                  }
                }).then(function(result) {
                  form.reset();
                  if (result.isConfirmed) {
                    var redirect_url = "{{ route('reservation.show', ':id') }}"
                    window.location = redirect_url.replace(':id', response.data.reservation_id)
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
              text: "Terjadi kesalahan, Silahkan cek kembali.",
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

    // Public methods
    return {
      init: function() {
        form = document.getElementById('alihkan_layanan_form');
        submitButton = form.querySelector('#alihkan_layanan_form_submit');

        initValidation();
        handleForm();
      }
    }
  }();

  // On document ready
  KTUtil.onDOMContentLoaded(function() {
    KTAModalAlihkanLayanan.init();
  });
</script>