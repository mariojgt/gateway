<?php
Route::group(array(
    'namespace'  => 'mariojgt\checkout\Modules\Dashboard\Controllers',
    'middleware' => ['web', 'CheckAuth'],
    'prefix'     => config('checkout.admindir')
), function () {
    Route::get('', 'DashboardController@index')->name('admin.dashboard');
    Route::get('dashboard', 'DashboardController@index')->name('admin.index');
});
