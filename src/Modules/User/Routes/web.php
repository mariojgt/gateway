<?php
Route::group(array(
    'namespace'  => 'mariojgt\gateway\Modules\User\Controllers',
    'middleware' => ['web', 'CheckAuth'],
    'prefix'     => config('gateway.admindir')
), function () {
    // Index file / list
    Route::get('user', 'UserController@index')
        ->name('admin.user.index');

    // Create a new one
    Route::get('user/add', 'UserController@create')
        ->name('admin.user.create');
    Route::post('user/add/{id}', 'UserController@store')
        ->name('admin.user.store');

    // Show details
    Route::get('user/view/{id}', 'UserController@show')
        ->name('admin.user.show');

    // Edit
    Route::get('user/edit/{id}', 'UserController@edit')
        ->name('admin.user.edit');
    Route::put('user/edit/{id}', 'UserController@update')
        ->name('admin.user.update');

    // Delete
    Route::delete('user/delete/{id}', 'UserController@delete')
        ->name('admin.user.delete');
});
