<?php
Route::group(array(
    'namespace'  => 'mariojgt\gateway\Modules\Dashboard\Controllers',
    'middleware' => ['web', 'CheckAuth'],
    'prefix'     => config('gateway.admindir')
), function () {
    Route::get('', 'DashboardController@index')->name('admin.dashboard');
    Route::get('dashboard', 'DashboardController@index')->name('admin.index');
});
