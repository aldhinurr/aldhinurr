<x-auth-layout>

    <!--begin::Signup Form-->
    <form method="POST" action="{{ theme()->getPageUrl('register') }}" class="form w-100" novalidate="novalidate" id="kt_sign_up_form">
    @csrf

    <!--begin::Heading-->
        <div class="text-center mb-10">
            <!--begin::Title-->
            <h1 class="text-dark mb-3">
                {{ __('Daftar menggunakan ITB Account') }}
            </h1>
            <!--end::Title-->
        </div>
        <!--end::Heading-->
    
        <!--begin::Separator-->
        <hr><br>
        <!--end::Separator-->

        <!--begin::Input group-->
        <div class="row fv-row mb-7">
            <!--begin::Col-->
            <div class="col-xl-6">
                <label class="form-label fw-bolder text-dark fs-6">{{ __('Nama Depan') }}</label>
                <input class="form-control form-control-lg form-control-solid" type="text" name="first_name" autocomplete="off"/>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-6">
                <label class="form-label fw-bolder text-dark fs-6">{{ __('Nama Belakang') }}</label>
                <input class="form-control form-control-lg form-control-solid" type="text" name="last_name" autocomplete="off"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-7">
            <label class="form-label fw-bolder text-dark fs-6">{{ __('ITB Account') }}</label>
            <input class="form-control form-control-lg form-control-solid" type="email" name="email" autocomplete="off"/>
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="mb-10 fv-row" data-kt-password-meter="true">
            <!--begin::Wrapper-->
            <div class="mb-1">
                <!--begin::Label-->
                <label class="form-label fw-bolder text-dark fs-6">
                    {{ __('Password') }}
                </label>
                <!--end::Label-->

                <!--begin::Input wrapper-->
                <div class="position-relative mb-3">
                    <input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="new-password"/>

                    <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                        <i class="bi bi-eye-slash fs-2"></i>
                        <i class="bi bi-eye fs-2 d-none"></i>
                    </span>
                </div>
                <!--end::Input wrapper-->

                <!--begin::Meter-->
                <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                    <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                </div>
                <!--end::Meter-->
            </div>
            <!--end::Wrapper-->

            <!--begin::Hint-->
            <div class="text-muted">
                {{ __('Gunakan 8 atau lebih karakter dengan campuran kata, nomor, dan simbol. (Misal: P4sword!)') }}
            </div>
            <!--end::Hint-->
        </div>
        <!--end::Input group--->

        <!--begin::Input group-->
        <div class="fv-row mb-5">
            <label class="form-label fw-bolder text-dark fs-6">{{ __('Konfirmasi Password') }}</label>
            <input class="form-control form-control-lg form-control-solid" type="password" name="password_confirmation" autocomplete="off"/>
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-10">
            <label class="form-check form-check-custom form-check-solid form-check-inline">
                <input class="form-check-input" type="checkbox" name="toc" value="1"/>
                <span class="form-check-label fw-bold text-gray-700 fs-6">
                {{ __('Saya setuju &') }} <a href="#" class="ms-1 link-primary">{{ __('Syarat dan Ketentuan') }}</a>.
            </span>
            </label>
        </div>
        <!--end::Input group-->

        <!--begin::Actions-->
        <div class="text-center">
        <button type="submit" id="kt_sign_up_submit" class="btn btn-lg btn-primary">
                @include('partials.general._button-indicator')
            </button><br>
            <a href="{{ url('logout') }}">Logout SSO</a>
        </div>
        <!--end::Actions-->
        
    </form>
    <!--end::Signup Form-->

</x-auth-layout>