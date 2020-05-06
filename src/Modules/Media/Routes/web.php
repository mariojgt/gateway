<?php
Route::group(array(
    'namespace'  => 'mariojgt\checkout\Modules\Media\Controllers',
    'middleware' => ['web'],
    'prefix'     => ''
), function () {
    // Index file / list
    Route::get('media', 'MediaController@index')
        ->name('admin.media.index');

    // Create a new one
    Route::get('media/add', 'MediaController@create')
        ->name('admin.media.create');
    Route::post('media/add/{id}', 'MediaController@store')
        ->name('admin.media.store');

    // Show details
    Route::get('media/view/{id}', 'MediaController@show')
        ->name('admin.media.show');

    // Edit
    Route::get('media/edit/{id}', 'MediaController@edit')
        ->name('admin.media.edit');
    Route::put('media/edit/{id}', 'MediaController@update')
        ->name('admin.media.update');

    // Delete
    Route::delete('media/delete/{id}', 'MediaController@delete')
        ->name('admin.media.delete');
});
