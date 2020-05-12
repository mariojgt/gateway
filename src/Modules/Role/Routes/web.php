<?php
Route::group(array(
    'namespace'  => 'mariojgt\gateway\Modules\Role\Controllers',
    'middleware' => ['web'],
    'prefix'     => ''
), function () {
    // Index file / list
    Route::get('role', 'RoleController@index')
        ->name('admin.role.index');

    // Create a new one
    Route::get('role/add', 'RoleController@create')
        ->name('admin.role.create');
    Route::post('role/add', 'RoleController@store')
        ->name('admin.role.store');

    // Show details
    Route::get('role/view/{id}', 'RoleController@show')
        ->name('admin.role.show');

    // Edit
    Route::get('role/edit/{id}', 'RoleController@edit')
        ->name('admin.role.edit');
    Route::put('role/edit/{id}', 'RoleController@update')
        ->name('admin.role.update');

    // Delete
    Route::delete('role/delete/{id?}', 'RoleController@destroy')
        ->name('admin.role.delete');
    Route::get('role/restore/{id}', 'RoleController@restore')
        ->name('admin.role.restore');
});
