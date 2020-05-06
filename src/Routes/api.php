<?php
Route::group(array(
    'namespace'  => 'mariojgt\checkout\Controllers',
    'middleware' => ['api'],
    'prefix'     => 'admin' //config('checkout.admindir')
), function () {
    // Route::apiResource('admin', 'AdminController');
});
