<?php

return array(
    // Main menu
    'main'          => array(
        // Dashboard
        array(
            'title' => 'Utama',
            'path'  => 'admin/index',
            'icon'  => theme()->getSvgIcon("demo1/media/icons/duotune/art/art002.svg", "svg-icon-2"),
        ),

        // Fasilitas
        array(
            'classes' => array('content' => 'pt-8 pb-2'),
            'content' => '<span class="menu-section text-muted text-uppercase fs-8 ls-1">Pendaftaran</span>',
            'role' => ["admin", "superadmin", "fasilitas", "fasilitas1"],
        ),

        array(
            'title' => 'Fasilitas',
            'path'  => 'admin/facility',
            'icon'  => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen016.svg", "svg-icon-2"),
            'role' => ["admin", "superadmin", "fasilitas", "fasilitas1"],
        ),

        array(
            'title' => 'Layanan',
            'path'  => 'admin/layanan',
            'icon'  => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen001.svg", "svg-icon-2"),
            'role' => ["admin", "superadmin", "fasilitas", "layanan"],
        ),

        // Pengelolaan
        array(
            'classes' => array('content' => 'pt-8 pb-2'),
            'content' => '<span class="menu-section text-muted text-uppercase fs-8 ls-1">Pengelolaan</span>',
            'role' => ["admin", "superadmin", "fasilitas", "fasilitas1"],
        ),

        array(
            'title' => 'Sewa Layanan',
            'path'  => 'admin/reservation/sewa',
            'icon'  => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen014.svg", "svg-icon-2"),
            'role' => ["admin", "superadmin", "fasilitas","sewa"],
        ),

        array(
            'title' => 'Resource Sharing',
            'path'  => 'admin/reservation/resource',
            'icon'  => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen013.svg", "svg-icon-2"),
            'role' => ["admin", "superadmin", "fasilitas","sewa"],
        ),

        // Laporan
        // array(
        //     'classes' => array('content' => 'pt-8 pb-2'),
        //     'content' => '<span class="menu-section text-muted text-uppercase fs-8 ls-1">Laporan</span>',
        //     'role' => ["admin", "superadmin", "laporan"],
        // ),

        // array(
        //     'title' => 'Laporan',
        //     'path'  => 'admin/report',
        //     'icon'  => theme()->getSvgIcon("demo1/media/icons/duotune/communication/com004.svg", "svg-icon-2"),
        //     'role' => ["admin", "superadmin", "laporan"],
        // ),

        // Lantai & Ruang
        array(
            'classes' => array('content' => 'pt-8 pb-2'),
            'content' => '<span class="menu-section text-muted text-uppercase fs-8 ls-1">Data Lantai & Ruang</span>',
            'role' => ["admin", "superadmin", "pemeliharaanSP", "pemeliharaanUNIT", "gedung", "lantai", "perbaikan"],
        ),

        // array(
        //     'title' => 'Pengajuan',
        //     'path'  => 'admin/repair',
        //     'icon'  => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen025.svg", "svg-icon-2"),
        //     'role' => ["admin", "superadmin", "pemeliharaanSP"],
        // ),

       // Data
        array(
            'title'      => 'Data',
            'role' => ["admin", "superadmin", "pemeliharaanSP", "pemeliharaanUNIT", "gedung", "lantai"],
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/general/gen017.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    // array(
                    //     'title'  => 'Gedung',
                    //     'path'   => 'admin/building',
                    //     'bullet' => '<span class="bullet bullet-dot"></span>',
                    //     'role' => ["admin", "superadmin", "pemeliharaanSP", "pemeliharaanUNIT", "gedung"],
                    // ),
                    array(
                        'title'  => 'Lantai & Ruang',
                        'path'   => 'admin/floor',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                        'role' => ["admin", "superadmin", "pemeliharaanSP", "pemeliharaanUNIT", "lantai"],

                    ),
                ),
            ),
        ),

        // Barang
        array(
            'classes' => array('content' => 'pt-8 pb-2'),
            'content' => '<span class="menu-section text-muted text-uppercase fs-8 ls-1">Informasi Barang</span>',
            'role' => ["admin", "superadmin", "barang"],
        ),

        array(
            'title' => 'Informasi Barang Tidak Digunakan',
            'path'   => 'admin/barang',
            'target' => '_blank',
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/files/fil019.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),
            'role' => ["admin", "superadmin", "barang"],
        ),       

        // Dokumen
        array(
            'classes' => array('content' => 'pt-8 pb-2'),
            'content' => '<span class="menu-section text-muted text-uppercase fs-8 ls-1">Dokumen</span>',
            'role' => ["admin", "superadmin", "pemeliharaanSP", "pemeliharaanUNIT", "layanan", "fasilitas", "user_role", "sewa", "gedung", "lantai", "perbaikan"],
        ),

        array(
            'title' => 'Panduan Pengelolaan',
            'path'  => '/private/pengelola/Admin%20-%20Panduan%20Pengelolaan%20Layanan%20E-Facility%20Versi%2008-Mar-2024.pdf',
            'target' => '_blank',
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/files/fil003.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),
            'role' => ["admin", "superadmin", "layanan", "fasilitas", "user_role", "sewa", "gedung", "lantai", "perbaikan"],
            'new-tab' => true,
        ),

        array(
            'title' => 'SK Tarif',
            'path'  => '/private/pengelola/SK%20Tarif.pdf',
            'target' => '_blank',
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/files/fil003.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),
            'role' => ["admin", "superadmin", "layanan", "fasilitas", "user_role", "sewa", "gedung", "lantai", "perbaikan"],
            'new-tab' => true,
        ),

        array(
            'title' => 'Laporkan Masalah/Masukkan',
            'path'  => 'https://forms.office.com/Pages/ResponsePage.aspx?id=gxFu22VMXECCznzVP6bp3BwL6TsNK-FChfwCiF2wSI1UM09SUjZHSVRWSjNVVUdNWEVOMlIxTkJUWS4u',
            'target' => '_blank',
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("demo1/media/icons/duotune/files/fil003.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),
            'role' => ["admin", "superadmin", "layanan", "fasilitas", "user_role", "sewa", "gedung", "lantai", "perbaikan"],
            'new-tab' => true,
        ),        

        // User
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
