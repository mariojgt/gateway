<?php
Event::listen('admin.menu', function ($menu) {
    $menu->add([
        'section'   => '',
        'position'  => 100,
        'menu'      =>
            [
                'text'      => 'Logout',
                'position'  => 1,
                'url'       => route('admin.logout'),
                'icon'      => 'icon-logout'
            ]
    ]);
});
