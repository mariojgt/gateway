<?php
Route::group(array(
    'namespace'  => 'mariojgt\gateway\Modules\Log\Controllers',
    'middleware' => ['web'],
    'prefix'     => ''
), function () {
    // Index file / list
    Route::get('log', 'LogController@index')
        ->name('admin.log.index');

    // Create a new one
    Route::get('log/add', 'LogController@create')
        ->name('admin.log.create');
    Route::post('log/add/{id}', 'LogController@store')
        ->name('admin.log.store');

    // Show details
    Route::get('log/view/{id}', 'LogController@show')
        ->name('admin.log.show');

    // Edit
    Route::get('log/edit/{id}', 'LogController@edit')
        ->name('admin.log.edit');
    Route::put('log/edit/{id}', 'LogController@update')
        ->name('admin.log.update');

    // Delete
    Route::delete('log/delete/{id}', 'LogController@delete')
        ->name('admin.log.delete');
});
