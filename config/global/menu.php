<?php

return array(
    // Main menu
    'main'          => array(
        //// Dashboard
        array(
            'title' => 'Utama',
            'path'  => 'admin/index',
            'icon'  => theme()->getSvgIcon("demo1/media/icons/duotune/art/art002.svg", "svg-icon-2"),
        ),

        //// Modules
        array(
            'classes' => array('content' => 'pt-8 pb-2'),
            'content' => '<span class="menu-section text-muted text-uppercase fs-8 ls-1">Modules</span>',
        ),

        array(
            'title' => 'Fasilitas',
            'path'  => 'admin/facility',
            'icon'  => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen016.svg", "svg-icon-2"),
            'role' => ["admin", "superadmin"],
        ),

        array(
            'title' => 'Layanan',
            'path'  => 'admin/layanan',
            'icon'  => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen001.svg", "svg-icon-2"),
            'role' => ["admin", "superadmin"],
        ),

        array(
            'title' => 'Sewa',
            'path'  => 'admin/reservation',
            'icon'  => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen014.svg", "svg-icon-2"),
            'role' => ["admin", "superadmin"],
        ),

        array(
            'title' => 'Laporan',
            'path'  => 'admin/report',
            'icon'  => theme()->getSvgIcon("demo1/media/icons/duotune/communication/com004.svg", "svg-icon-2"),
            'role' => ["admin", "superadmin"],
        ),


        //// User
        /* array(
            'classes' => array('content' => 'pt-8 pb-2'),
            'content' => '<span class="menu-section text-muted text-uppercase fs-8 ls-1">User</span>',
        ),

        // Account
        array(
            'title'      => 'Account',
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/communication/com006.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Overview',
                        'path'   => 'account/overview',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Settings',
                        'path'   => 'account/settings',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ), */
    ),

    // Horizontal menu
    'horizontal'    => array(),
);
