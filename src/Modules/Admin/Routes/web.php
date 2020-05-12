<?php
Route::group(array(
    'namespace'  => 'mariojgt\gateway\Modules\Admin\Controllers',
    'middleware' => ['web', 'CheckAuth'],
    'prefix'     => config('gateway.admindir')
), function () {
    // Index file / list
    Route::get('admin', 'AdminController@index')
        ->name('admin.admin.index');

    // Create a new one
    Route::get('admin/add', 'AdminController@create')
        ->name('admin.admin.create');
    Route::post('admin/add', 'AdminController@store')
        ->name('admin.admin.store');

    // Show details
    Route::get('admin/view/{id}', 'AdminController@show')
        ->name('admin.admin.show');

    // Edit
    Route::get('admin/edit/{id}', 'AdminController@edit')
        ->name('admin.admin.edit');
    Route::put('admin/edit/{id}', 'AdminController@update')
        ->name('admin.admin.update');

    // Delete
    Route::delete('admin/delete/{id}', 'AdminController@delete')
        ->name('admin.admin.delete');
});
