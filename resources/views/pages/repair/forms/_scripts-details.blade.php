<script text="javascript">
  "use strict";
  // Class definition
  var KTAReservationDetail = function() {
    // Private variables
    var form;
    var submitButton;
    var validation;
    var myDropzone;


    // Private functions
    var initValidation = function() {
      // Init form validation rules. For more info check the FormValidation plugin's official documentation: https://formvalidation.io/
      validation = FormValidation.formValidation(
        form, {
          fields: {
            status: {
              validators: {
                notEmpty: {
                  message: 'Silahkan pilih Jenis Layanan'
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
      $(form.querySelector('[name="status"]')).on('change', function() {
        // Revalidate the color field when an option is chosen
        validation.revalidateField('status');
      });
    }


    var handleForm = function() {
      $("#tanggal_selesai").daterangepicker({
        autoUpdateInput: false,
        autoApply: true,
        singleDatePicker: true,
        minYear: 2020,
        locale: {
          format: "DD/MM/YYYY",
          cancelLabel: 'Clear'
        }
      });

      $('input[name="tanggal_selesai"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format("DD/MM/YYYY"));
      });

      $('input[name="tanggal_selesai"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
      });

      $('[id="status"]').select2({
        data: [{
            id: 'MENUNGGU',
            text: 'MENUNGGU'
          },
          {
            id: 'SEDANG DIPERIKSA',
            text: 'SEDANG DIPERIKSA'
          },
          {
            id: 'SEDANG DIKERJAKAN',
            text: 'SEDANG DIKERJAKAN'
          },
          {
            id: 'DIALIHKAN',
            text: 'DIALIHKAN'
          },
          {
            id: 'SELESAI',
            text: 'SELESAI'
          },
        ]
      });
      $('[id="status"]').val("{{ $report->status }}");
      $('[id="status"]').trigger('change');
      $('[id="status"]').on('select2:select', function(e) {
        var data = e.params.data
        $('#alasan_dialihkan_input').attr("hidden", true)
        if (data.id == "DIALIHKAN") {
          $('#alasan_dialihkan_input').attr("hidden", false)
        }
      });

      myDropzone = new Dropzone("#report_images_upload", {
        url: "{{ route('layanan-gambar.upload') }}", // Set the url for your upload script location
        paramName: "file", // The name that will be used to transfer the file
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        maxFiles: 10,
        maxFilesize: 10, // MB
        thumbnailWidth: 500,
        addRemoveLinks: true,
        autoProcessQueue: false,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        accept: function(file, done) {
          if (file.name == "wow.jpg") {
            done("Naha, you don't.");
          } else {
            done();
          }
        },
        success: function(file, response) {
          file.previewElement.id = response.success;
          // set new images names in dropzone’s preview box.
          var olddatadzname = file.previewElement.querySelector("[data-dz-name]");
          file.previewElement.querySelector("img").alt = response.success;
          olddatadzname.innerHTML = response.success;
        },
        error: function(file, response) {
          return false;
        },
        init: function() {
          myDropzone = this;
          var files = <?= json_encode($oldImages, JSON_PRETTY_PRINT) ?>;
          files.map((file) => {
            myDropzone.files.push(file);
            myDropzone.displayExistingFile(file, file['path'], null, null, true);
            myDropzone.emit("complete", file);
          })

          this.on("addedfile", file => {
            myDropzone.emit("complete", file);
            console.log("A file has been added");
          });
        },
      });

      submitButton.addEventListener('click', function(e) {
        e.preventDefault();

        var data = new FormData(form);

        // assign multiple file
        for (let index = 0; index < myDropzone.files.length; index++) {
          var file = myDropzone.files[index];
          if (!file.type) {
            file = JSON.stringify(file);
          }
          data.append(`report_images[${index}]`, file);
        }

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
                  text: response.data.message,
                  icon: "success",
                  buttonsStyling: false,
                  confirmButtonText: "Ok",
                  customClass: {
                    confirmButton: "btn btn-primary"
                  }
                }).then(function(result) {
                  form.reset();
                  if (result.isConfirmed) {
                    window.location = "{{ route('report.index') }}"
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
              text: "Terjadi kesalahan, silahkan cek kembali",
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
        form = document.getElementById('kt_report_update_form');
        submitButton = form.querySelector('#kt_report_update_submit');

        initValidation();
        handleForm();
      }
    }
  }();

  // On document ready
  KTUtil.onDOMContentLoaded(function() {
    KTAReservationDetail.init();
  });
</script>