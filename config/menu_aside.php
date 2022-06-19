<?php
// Aside menu
return [

    'admin' => [
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg',
            'page' => '/admin',
            'new-tab' => false,
        ],
        [
            'title' => 'Transactions',
            'root' => true,
            'icon' => 'media/svg/icons/Shopping/Barcode-scan.svg',
            'page' => '/admin/transactions',
            'new-tab' => false,
        ],
        [
            'section' => 'Master Data',
        ],
        [
            'title' => 'Admins',
            'root' => true,
            'icon' => 'media/svg/icons/General/User.svg',
            'page' => '/admin/admins',
            'new-tab' => false,
        ],
        [
            'title' => 'Users',
            'root' => true,
            'icon' => 'media/svg/icons/Files/User-folder.svg',
            'page' => '/admin/users',
            'new-tab' => false,
        ],
        [
            'title' => 'Categories',
            'root' => true,
            'icon' => 'media/svg/icons/Media/Playlist2.svg',
            'page' => '/admin/categories',
            'new-tab' => false,
        ],
        [
            'title' => 'Products',
            'root' => true,
            'icon' => 'media/svg/icons/Home/Box.svg',
            'page' => '/admin/products',
            'new-tab' => false,
        ],
        [
            'title' => 'Payment Methods',
            'root' => true,
            'icon' => 'media/svg/icons/Shopping/Money.svg',
            'page' => '/admin/payment-methods',
            'new-tab' => false,
        ],
        [
            'section' => 'Settings',
        ],
        [
            'title' => 'Settings',
            'root' => true,
            'icon' => 'media/svg/icons/General/Settings-2.svg',
            'page' => '/admin/settings',
            'new-tab' => false,
        ],

    ],
    'user' => [
        [
            'title' => 'Dashboard',
            'root' => true,
            'icon' => 'media/svg/icons/Design/Layers.svg',
            'page' => '/',
            'new-tab' => false,
        ],
        [
            'title' => 'My Cart',
            'root' => true,
            'icon' => 'media/svg/icons/Shopping/Cart1.svg',
            'page' => '/cart',
            'new-tab' => false,
        ],
        [
            'title' => 'Transactions',
            'root' => true,
            'icon' => 'media/svg/icons/Shopping/Barcode-scan.svg',
            'page' => '/transactions',
            'new-tab' => false,
        ],
    ]
];
