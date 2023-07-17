<!--begin::Action--->
<td class="text-end">
  <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-kt-menu-trigger="click"
    data-kt-menu-placement="bottom-end">
    <i class="bi bi-three-dots fs-3"></i>
  </button>

  <!--begin::Menu 3-->
  <div
    class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3"
    data-kt-menu="true">

    <!--begin::Menu item-->
    <div class="menu-item px-3">
      <a href="{{ route('layanan.show', $model->id) }}" class="menu-link px-3">
        Detail
      </a>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu item-->
    <div class="menu-item px-3">
      <a href="{{ route('layanan.edit', $model->id) }}" class="menu-link flex-stack px-3">
        Edit
      </a>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu item-->
    <div class="menu-item px-3">
      <a href="#" class="menu-link px-3 delete_menu_item">
        Hapus
      </a>
    </div>
    <!--end::Menu item-->
  </div>
  <!--end::Menu 3-->
</td>
<!--end::Action--->
