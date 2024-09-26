<script text="javascript">
  "use strict";
  // Class definition
  var KTALayananForms = function() {
    // Private variables
    var form;
    var submitButton;
    var validation;
    var myDropzone;
    var editor;
    var myRepeater;
    var description;
    var layananGambar;

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
            capacity: {
              validators: {
                notEmpty: {
                  message: 'kapasitas belum diisi'
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
    }

    var changeInputLarge = function() {
      var type = $('[id="type"]').val();
      var titleInput = "Luas";
      var htmlInput = `
        <input type="number" min="1" id="large" name="large"
          class="form-control form-control-lg form-control-solid mb-lg-0 mb-3" value="{{ old('large', $layanan->large ?? '') }}" />
        <span class="input-group-text" id="basic-addon2">m<sup>2</sup></span>
        `

      if (type == "KENDARAAN") {
        titleInput = "Jenis";
        htmlInput = `
          <select id="large" name="large" aria-label="{{ __('Pilih Kendaraan') }}"
            data-placeholder="{{ __('Pilih Kendaraan...') }}"
            class="form-select form-select-solid form-select-lg fw-bold">
          </select>
          `
      }

      if (type == "RKU") {
        titleInput = "Lantai";
        htmlInput = `
        <input type="number" min="1" id="large" name="large"
          class="form-control form-control-lg form-control-solid mb-lg-0 mb-3" value="1" />
          `
      }

      $('#label-large').text(titleInput);
      $('#div-large').empty();
      $('#div-large').append(htmlInput);

      // init select2 large
      if (type == "KENDARAAN") {
        $('[id="large"]').select2({
          data: [{
              id: 1,
              text: 'Mobil'
            },
            {
              id: 2,
              text: 'Motor'
            },
            {
              id: 3,
              text: 'Shuttle'
            },
            {
              id: 4,
              text: 'Bis'
            },
            {
              id: 5,
              text: 'Truk'
            },
          ]
        });
      }
    }

    var handleForm = function() {
      $('[id="type"]').select2({
        data: [          
          {
            id: "KENDARAAN",
            text: 'Kendaraan'
          },
          {
            id: "LAPANGAN",
            text: 'Lapangan'
          },
          {
            id: "RKU",
            text: 'Ruang Kuliah Umum'
          },
          {
            id: "RUANG",
            text: 'Ruang'
          },
          {
            id: "RUMAH SUSUN",
            text: 'Rumah Susun / Transit'
          },
          {
            id: "SELASAR",
            text: 'Selasar'
          },
          {
            id: "PERALATAN",
            text: 'Peralatan'
          },
        ]
      });
      $('[id="type"]').val("{{ $layanan->type }}");
      $('[id="type"]').trigger('change');
      $('[id="type"]').on('select2:select', function(e) {
        changeInputLarge();
      });

      Inputmask("Rp. 999.999.999", {
        "numericInput": true
      }).mask("#price");

      ClassicEditor
        .create(document.querySelector('#editor_description'))
        .then(newEditor => {
          editor = newEditor;
          editor.setData("{!! old('description', $layanan->description ?? '') !!}");
        })
        .catch(error => {
          console.error(error);
        });

      myDropzone = new Dropzone("#layanan_gambar_upload", {
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
        // removedfile: function(file) {
        //   var name = file.previewElement.querySelector("[data-dz-name]").innerHTML;
        //   $.ajax({
        //     headers: {
        //       'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //     },
        //     type: 'POST',
        //     url: "{{ route('layanan-gambar.delete') }}",
        //     data: {
        //       filename: name,

        //     },
        //     success: function(data) {
        //       console.log("File has been successfully removed!!");
        //     },
        //     error: function(e) {
        //       console.log(e);
        //     }
        //   });
        //   var fileRef;
        //   return (fileRef = file.previewElement) != null ?
        //     fileRef.parentNode.removeChild(file.previewElement) : void 0;
        // },
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
          var files = <?= json_encode($gambars, JSON_PRETTY_PRINT) ?>;
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

      myRepeater = $('#facility').repeater({
        initEmpty: false,

        defaultValues: {
          'type': 'UTAMA',
          'quantity': '1',
          'fee': '0'
        },

        show: function() {
          $(this).slideDown();

          // Re-init select2
          $(this).find('[data-kt-repeater="select2"]').select2();
          $(this).find('[data-kt-repeater="select2-facility"]').select2({
            ajax: {
              url: "{{ route('facility.getFacilities') }}",
              type: "post",
              dataType: 'json',
              delay: 250,
              data: function(params) {
                return {
                  _token: '{{ csrf_token() }}',
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

        },

        hide: function(deleteElement) {
          $(this).slideUp(deleteElement);
        },

        ready: function() {
          // Init select2
          $('[data-kt-repeater="select2"]').select2();
          $('[data-kt-repeater="select2-facility"]').select2({
            ajax: {
              url: "{{ route('facility.getFacilities') }}",
              type: "post",
              dataType: 'json',
              delay: 250,
              data: function(params) {
                return {
                  _token: '{{ csrf_token() }}',
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
        }
      });

      // set facilitiesl
      var facilities = <?= json_encode($facilities, JSON_PRETTY_PRINT) ?>;
      if (facilities.length > 0) {
        var setList = [];
        for (let idx = 0; idx < facilities.length; idx++) {
          const e = facilities[idx];
          setList.push({
            'facility_id': e['facility_id'],
            'facility_name': e['facility']['name'],
            'type': e['type'],
            'fee': e['fee'],
            'quantity': e['quantity'],
          })
        }
        myRepeater.setList(setList);

        for (let idx = 0; idx < setList.length; idx++) {
          const e = setList[idx];
          var newOption = new Option(e['facility_name'], e['facility_id'], true, true);
          $('[name="facility[' + idx + '][facility_id]"]').append(newOption).trigger('change');
        }
      }

      submitButton.addEventListener('click', function(e) {
        e.preventDefault();

        var data = new FormData(form);
        data.set('price', form.querySelector("#price").inputmask.unmaskedvalue());
        data.append('description', editor.getData());

        // assign multiple file
        for (let index = 0; index < myDropzone.files.length; index++) {
          var file = myDropzone.files[index];
          if (!file.type) {
            file = JSON.stringify(file);
          }
          data.append('layanan_gambar[]', file);
        }

        // assign value fasilitas
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
                  text: "Layanan Berhasil Diubah",
                  icon: "success",
                  buttonsStyling: false,
                  confirmButtonText: "Ok",
                  customClass: {
                    confirmButton: "btn btn-primary"
                  }
                }).then(function(result) {
                  form.reset();
                  if (result.isConfirmed) {
                    window.location = "{{ route('layanan.index') }}"
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
        form = document.getElementById('kt_layanan_layanan_create_form');
        submitButton = form.querySelector('#kt_layanan_layanan_create_submit');
        description = form.querySelector("#description")
        layananGambar = form.querySelector("#layanan_gambar")

        initValidation();
        handleForm();
        changeInputLarge();

        // set value large
        $('[id="large"]').val("{{ $layanan->large }}");
        $('[id="large"]').trigger('change');
      }
    }
  }();

  // On document ready
  KTUtil.onDOMContentLoaded(function() {
    KTALayananForms.init();
  });


  // Script Location
  document.addEventListener('DOMContentLoaded', function() {
    // Define the locations
    const locations = ['CIREBON', 'GANESHA', 'JAKARTA', 'JATINANGOR'];
    
    // Get the layanan's current location
    const layananLocation = "{{ $layanan->location }}";
    
    // Get the select element
    const selectElement = document.getElementById('location');
    
    // Populate the select element with options
    locations.forEach(location => {
      const option = document.createElement('option');
      option.value = location;
      option.text = location;
      if (location === layananLocation) {
        option.selected = true;
      }
      selectElement.appendChild(option);
    });
  });

</script>