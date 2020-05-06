<?php
Event::listen('admin.menu', function ($menu) {
    $menu->add([
        'section'   => '',
        'position'  => 1,
        'menu'      => [
            'text'      => 'Dashboard',
            'position'  => 1,
            'url'       => route('admin.index'),
            'icon'      => 'icon-speedometer'
        ]
    ]);

    $menu->add([
        'section'   => '',
        'position'  => 10,
        'menu'      => [
            'text'      => 'Admins',
            'position'  => 10,
            'icon'      => 'icon-user',
            'menu'      => [
                [
                    'text'      => 'List',
                    'position'  => 1,
                    'url'       => route('admin.admin.index')
                ],
                [
                    'text'      => 'Create',
                    'position'  => 2,
                    'url'       => route('admin.admin.create'),
                    'acl'       => 'admin, superadmin'
                ]
            ]
        ]
    ]);

    $menu->add([
        'section'   => '',
        'position'  => 10,
        'menu'      => [
            'text'      => 'Customers',
            'position'  => 15,
            'icon'      => 'icon-people',
            'menu'      => [
                [
                    'text'      => 'List',
                    'position'  => 1,
                    'url'       => route('admin.user.index')
                ],
                [
                    'text'      => 'Create',
                    'position'  => 2,
                    'url'       => route('admin.user.create')
                ]
            ]
        ]
    ]);

    $menu->add([
        'section'   => '',
        'position'  => 15,
        'menu'      => [
            'text'      => 'Pages',
            'position'  => 5,
            'icon'      => 'icon-note',
            'menu'      => [
                [
                    'text'      => 'List',
                    'position'  => 5,
                    'url'       => route('admin.page.index')
                ],
                [
                    'text'      => 'Create',
                    'position'  => 10,
                    'url'       => route('admin.page.create')
                ]
            ]
        ]
    ]);

    $menu->add([
        'section'   => '',
        'position'  => 15,
        'menu'      => [
            'text'      => 'Media Library',
            'position'  => 10,
            'icon'      => 'icon-camera',
            'url'       => route('admin.media.index')
        ]
    ]);

    $menu->add([
        'section'   => '',
        'position'  => 80,
        'menu'      => [
            'text'      => 'Reports',
            'position'  => 5,
            'icon'      => 'icon-book-open',
            'menu'      => [
                [
                    'text'      => 'Logs',
                    'position'  => 5,
                    'url'       => route('admin.log.index')
                ]
            ]
        ]
    ]);

    $menu->add([
        'section'   => '',
        'position'  => 80,
        'menu'      => [
            'text'      => 'Messages',
            'position'  => 10,
            'icon'      => 'icon-envelope-open',
            'menu'      => [
                [
                    'text'      => 'Inbox',
                    'position'  => 5,
                    'url'       => route('admin.message.index')
                ],
                [
                    'text'      => 'Sent Items',
                    'position'  => 10,
                    'url'       => ''
                ],
                [
                    'text'      => 'Deleted',
                    'position'  => 15,
                    'url'       => ''
                ],
                [
                    'text'      => 'New Message',
                    'position'  => 20,
                    'url'       => ''
                ]
            ]
        ]
    ]);
    
    $menu->add([
        'section'   => '',
        'position'  => 90,
        'menu'      => [
            'text'      => 'Settings',
            'position'  => '10',
            'icon'      => 'icon-settings',
            'menu'      => [
                [
                    'text'      => 'Configuration',
                    'position'  => 5,
                    'url'       => route('admin.configuration.index')
                ],
                [
                    'text'      => 'User Roles',
                    'position'  => 10,
                    'url'       => route('admin.role.index')
                ],
                [
                    'text'      => 'Backup',
                    'position'  => 15,
                    'url'       => route('admin.backup.index')
                ]
            ]
        ]
    ]);
});
