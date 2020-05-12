<?php
Route::group(array(
    'namespace'  => 'mariojgt\gateway\Controllers',
    'middleware' => ['api'],
    'prefix'     => 'admin' //config('gateway.admindir')
), function () {
    // Route::apiResource('admin', 'AdminController');
});
