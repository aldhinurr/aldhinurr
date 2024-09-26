<x-auth-layout>
@if(session('alert'))
    <div class="alert alert-danger text-center">
        <strong>{!! session('alert') !!}</strong>
    </div>
@endif

  <!--begin::Signin Form-->
  <form method="POST" action="{{ theme()->getPageUrl('login-page') }}" class="form w-100" novalidate="novalidate"
    id="kt_sign_in_form">
    @csrf

 
    <!--begin::Input group-->
    <div class="fv-row mb-10">
      <!--begin::Label-->
      <label class="form-label fs-6 fw-bolder text-dark">{{ __('Akun Office ITB') }}</label>
      <!--end::Label-->

      <!--begin::Input-->
      <input class="form-control form-control-lg form-control-solid" type="email" name="email" autocomplete="off"
        value="{{ old('email') }}" required autofocus />
      <!--end::Input-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="fv-row mb-10">
      <!--begin::Wrapper-->
      <div class="d-flex flex-stack mb-2">
        <!--begin::Label-->
        <label class="form-label fw-bolder text-dark fs-6 mb-0">{{ __('Kata Kunci') }}</label>
        <!--end::Label-->

        <!--begin::Link-->
        @if (Route::has('password.request'))
          <a href="{{ theme()->getPageUrl('password.request') }}" class="link-primary fs-6 fw-bolder">
        {{ __('Forgot Password ?') }}
        </a>
        @endif
        <!--end::Link-->
      </div>
      <!--end::Wrapper-->

      <!--begin::Input-->
      <input class="form-control form-control-lg form-control-solid" type="password" name="password" autocomplete="off"
        required />
      <!--end::Input-->
    </div>
    <!--end::Input group-->

        <!--begin::Actions-->
    <div class="text-center">
      <!--begin::Submit button-->
      <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
         <!-- 'at'include('partials.general._button-indicator', ['label' => __('Masuk')]) -->
         {{ __('Masuk') }}
      </button>
      <!--end::Submit button-->
 

      <!--begin::Microsoft link -->
      <div style="text-align: center;">
        <a href="{{ route('login-azure') }}" class="btn btn-dark"><img alt="Logo" src="{{ asset(theme()->getMediaUrlPath() . 'svg/brand-logos/microsoft-5.svg') }}" class="h-20px me-3" />
          <!-- id="login-itb" class="btn btn-lg btn-primary w-100 mb-5"> -->
          {{ __('Masuk dengan ITB Account') }}
        </a>
          <p>
            <h4><a href="{{ route('website.index') }}">{{ __('Kembali') }}</a></h4>
      </div>
      <!--end::Google link-->
      </div>
    <!--end::Actions-->
  </form>
  <!--end::Signin Form-->

</x-auth-layout>
