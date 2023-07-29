@php
  $toolbarButtonMarginClass = 'ms-1 ms-lg-3';
  $toolbarButtonHeightClass = 'w-40px h-40px';
  $toolbarUserAvatarHeightClass = 'symbol-40px';
  $toolbarButtonIconSizeClass = 'svg-icon-1';
@endphp

{{-- begin::Toolbar wrapper --}}
<div class="d-flex align-items-stretch flex-shrink-0">

  {{-- begin::User --}}
  @if (Auth::check())
    <div class="d-flex align-items-center {{ $toolbarButtonMarginClass }}" id="kt_header_user_menu_toggle">
      <div class="fv-row px-3 pt-1">
        <div class="fw-bolder d-flex align-items-center fs-5">
          {{ auth()->user()->name }}
        </div>
      </div>

      {{-- begin::Menu --}}
      <div class="cursor-pointer symbol {{ $toolbarUserAvatarHeightClass }}" data-kt-menu-trigger="click"
        data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
        <img src="{{ auth()->user()->avatarUrl }}" alt="metronic" />
      </div>
      {{ theme()->getView('partials/topbar/_user-menu') }}
      {{-- end::Menu --}}
    </div>
  @endif
  {{-- end::User --}}

  {{-- begin::Heaeder menu toggle --}}
  @if (theme()->getOption('layout', 'header/left') === 'menu')
    <div class="d-flex align-items-center d-lg-none ms-2 me-n3" data-bs-toggle="tooltip" title="Show header menu">
      <div class="btn btn-icon btn-active-light-primary" id="kt_header_menu_mobile_toggle">
        {!! theme()->getSvgIcon('icons/duotune/text/txt001.svg', 'svg-icon-1') !!}
      </div>
    </div>
  @endif
  {{-- end::Heaeder menu toggle --}}
</div>
{{-- end::Toolbar wrapper --}}
