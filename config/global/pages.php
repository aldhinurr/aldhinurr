<?php
return array(
    "index" => array(
        "title"       => "Utama",
        "description" => "",
        "view"        => "index",
        "layout"      => array(
            "page-title" => array(
                "description" => true,
                "breadcrumb"  => false,
            ),
        ),
        "assets"      => array(
            "custom" => array(
                "js" => array(),
            ),
        ),
    ),

    "login"           => array(
        "title"  => "Login",
        "assets" => array(
            "custom" => array(
                "js" => array(
                    "js/custom/authentication/sign-in/general.js",
                ),
            ),
        ),
        "layout" => array(
            "main" => array(
                "type" => "blank", // Set blank layout
                "body" => array(
                    "class" => theme()->isDarkMode() ? "" : "bg-body",
                ),
            ),
        ),
    ),
    "register"        => array(
        "title"  => "Register",
        "assets" => array(
            "custom" => array(
                "js" => array(
                    "js/custom/authentication/sign-up/general.js",
                ),
            ),
        ),
        "layout" => array(
            "main" => array(
                "type" => "blank", // Set blank layout
                "body" => array(
                    "class" => theme()->isDarkMode() ? "" : "bg-body",
                ),
            ),
        ),
    ),
    "forgot-password" => array(
        "title"  => "Forgot Password",
        "assets" => array(
            "custom" => array(
                "js" => array(
                    "js/custom/authentication/password-reset/password-reset.js",
                ),
            ),
        ),
        "layout" => array(
            "main" => array(
                "type" => "blank", // Set blank layout
                "body" => array(
                    "class" => theme()->isDarkMode() ? "" : "bg-body",
                ),
            ),
        ),
    ),

    "account" => array(
        "overview" => array(
            "title"  => "Account Overview",
            "view"   => "account/overview/overview",
            "assets" => array(
                "custom" => array(
                    "js" => array(
                        "js/custom/widgets.js",
                    ),
                ),
            ),
        ),

        "settings" => array(
            "title"  => "Account Settings",
            "assets" => array(
                "custom" => array(
                    "js" => array(
                        "js/custom/account/settings/profile-details.js",
                        "js/custom/account/settings/signin-methods.js",
                        "js/custom/modals/two-factor-authentication.js",
                    ),
                ),
            ),
        ),
    ),

    "users"         => array(
        "title" => "User List",

        "*" => array(
            "title" => "Show User",

            "edit" => array(
                "title" => "Edit User",
            ),
        ),
    ),

    "admin" => array(
        "layanan"  => array(
            "*" => array(
                "title"  => "Layanan",
                "view"   => "layanan",
                "assets" => array(
                    "custom" => array(
                        "css" => array(
                            "plugins/global/plugins.bundle.css",
                            "plugins/custom/datatables/datatables.bundle.css",
                        ),
                        "js"  => array(
                            "plugins/global/plugins.bundle.js",
                            "plugins/custom/datatables/datatables.bundle.js",
                            "plugins/custom/ckeditor/ckeditor-classic.bundle.js",
                            "plugins/custom/fslightbox/fslightbox.bundle.js",
                            "plugins/custom/formrepeater/formrepeater.bundle.js"
                        ),
                    ),
                ),
            ),
        ),

        "facility"  => array(
            "*" => array(
                "title"  => "Fasilitas",
                "view"   => "facility",
                "assets" => array(
                    "custom" => array(
                        "css" => array(
                            "plugins/custom/datatables/datatables.bundle.css",
                        ),
                        "js"  => array(
                            "plugins/custom/datatables/datatables.bundle.js",
                        ),
                    ),
                ),
            ),
        ),

        "reservation"  => array(
            "*" => array(
                "title"  => "Sewa",
                "view"   => "reservation",
                "assets" => array(
                    "custom" => array(
                        "css" => array(
                            "plugins/custom/datatables/datatables.bundle.css",
                        ),
                        "js"  => array(
                            "plugins/custom/datatables/datatables.bundle.js",
                            "plugins/custom/formrepeater/formrepeater.bundle.js"
                        ),
                    ),
                ),
            ),
        ),

        "report"  => array(
            "*" => array(
                "title"  => "Laporan",
                "view"   => "report",
                "assets" => array(
                    "custom" => array(
                        "css" => array(
                            "plugins/custom/datatables/datatables.bundle.css",
                        ),
                        "js"  => array(
                            "plugins/custom/datatables/datatables.bundle.js",
                            "plugins/custom/fslightbox/fslightbox.bundle.js",
                        ),
                    ),
                ),
            ),
        ),
    )

);
