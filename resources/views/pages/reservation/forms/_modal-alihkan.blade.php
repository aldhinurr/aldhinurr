<!--begin::Modal - Two-factor authentication-->
<div class="modal fade" id="alihkan_layanan" tabindex="-1" aria-hidden="true">
  <!--begin::Modal header-->
  <div class="modal-dialog modal-dialog-centered mw-950px">
    <!--begin::Modal content-->
    <div class="modal-content">
      <!--begin::Modal header-->
      <div class="modal-header flex-stack">
        <!--begin::Title-->
        <h2>Pilih Ruangan / Kendaraan yang baru</h2>
        <!--end::Title-->

        <!--begin::Close-->
        <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
          {!! theme()->getSvgIcon('icons/duotune/arrows/arr061.svg', 'svg-icon-1') !!}
        </div>
        <!--end::Close-->
      </div>
      <!--begin::Modal header-->

      <!--begin::Form-->
      <form id="alihkan_layanan_form" class="form" method="POST"
        action="{{ route('reservation.move', $reservation->id) }}">
        <!--begin::Modal body-->
        <div class="modal-body scroll-y pt-10 pb-15 px-lg-17">
          <div id="alihkan_layanan">
            <input type="hidden" name="old_layanan_id" id="old_layanan_id" value="{{ $reservation->layanan->id }}">
            <input type="hidden" name="old_layanan_type" id="old_layanan_type"
              value="{{ $reservation->layanan->type }}">
            <input type="hidden" name="old_layanan_price" id="old_layanan_price"
              value="{{ $reservation->layanan->price }}">
            <input type="hidden" name="new_layanan_price" id="new_layanan_price">

            <!--begin::Input group-->
            <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-lg-3 col-form-label required fw-bold fs-6">{{ __('Ruangan / Kendaraan') }}</label>
              <!--end::Label-->

              <!--begin::Col-->
              <div class="col-lg-8 fv-row">
                <select class="form-select form-select-solid" name="new_layanan_id" id="new_layanan_id"
                  data-placeholder="Pilih Ruangan / Kendaraan...">
                </select>
              </div>
              <!--end::Col-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-lg-3 col-form-label fw-bold fs-6">
                {{ __('Fasilitas Tambahan') }}
              </label>
              <!--end::Label-->

              <!--begin::Col-->
              <div class="col-lg-8 fv-row">
                <!--begin::Repeater-->
                <div id="facility">
                  <!--begin::Form group-->
                  <div class="form-group">
                    <div data-repeater-list="facility">
                      <div data-repeater-item>
                        <input type="hidden" name="facilty_fee">
                        <input type="hidden" name="facilty_fee_for">
                        <div class="form-group row mb-5">
                          <div class="col-md-10">
                            <select class="form-select form-select-solid" name="facility_id"
                              data-kt-repeater="select2-facility" data-placeholder="Pilih Fasilitas">
                            </select>
                          </div>
                          <div class="col-md-1">
                            <a href="javascript:;" data-repeater-delete
                              class="btn btn-flex btn-light-danger mt-1 align-items-center">
                              <i class="bi bi-trash"></i>
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!--end::Form group-->

                  <!--begin::Form group-->
                  <div class="form-group">
                    <a href="javascript:;" data-repeater-create class="btn btn-flex btn-light-primary">
                      Tambah
                    </a>
                  </div>
                  <!--end::Form group-->
                </div>
                <!--end::Repeater-->
              </div>
              <!--end::Col-->
            </div>
            <!--end::Input group-->


            <!--begin::Input group-->
            <div class="row mb-6">
              <!--begin::Label-->
              <label class="col-lg-3 col-form-label fw-bold fs-6">
                <span class="required">{{ __('Keterangan') }}</span>
              </label>
              <!--end::Label-->

              <!--begin::Col-->
              <div class="col-lg-8 fv-row">
                <textarea id="description" name="description" class="form-control form-control-lg form-control-solid"></textarea>
              </div>
              <!--end::Col-->
            </div>
            <!--end::Input group-->
          </div>
        </div>
        <!--begin::Modal body-->

        <!--begin::Actions-->
        <div class="modal-footer d-flex justify-content-end px-9 py-6">
          <button type="button" class="btn btn-primary" id="alihkan_layanan_form_submit">
            @include('partials.general._button-indicator', ['label' => __('Simpan')])
          </button>
        </div>
        <!--end::Actions-->
      </form>
      <!--end::Form-->
    </div>
    <!--end::Modal content-->
  </div>
  <!--end::Modal header-->
</div>
<!--end::Modal - Two-factor authentication-->
