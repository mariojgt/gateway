<?php
Route::group(array(
    'middleware' => ['web', 'CheckGuest'],
    'prefix'     => config('checkout.admindir'),
    'namespace'  => 'mariojgt\checkout\Modules\Login\Controllers',
), function () {
    // Login and Authenticate
    Route::get('login', 'LoginController@index')
        ->name('admin.login');
    Route::post('login', 'LoginController@authenticate')
        ->name('admin.authenticate');

    // // Password Reset And Send Reminder
    Route::post('password/email', 'AdminForgotPasswordController@sendResetLinkEmail')
        ->name('admin.password.email');
    Route::get('password/reset', 'AdminForgotPasswordController@showLinkRequestForm')
        ->name('admin.password.request');

    // Password Reset and Login
    Route::post('password/reset', 'AdminResetPasswordController@reset');
    Route::get('password/reset/{token}', 'AdminResetPasswordController@showResetForm')
        ->name('admin.password.reset');
});

Route::group(array(
    'middleware' => ['web', 'CheckAuth'],
    'prefix'     => config('checkout.admindir'),
    'namespace'  => 'mariojgt\checkout\Modules\Login\Controllers'
), function () {
    Route::get('logout', 'LoginController@logout')
        ->name('admin.logout');
});
