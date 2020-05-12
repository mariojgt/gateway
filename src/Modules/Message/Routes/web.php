<?php
Route::group(array(
    'namespace'  => 'mariojgt\gateway\Modules\Message\Controllers',
    'middleware' => ['web'],
    'prefix'     => ''
), function () {
    // Index file / list
    Route::get('message', 'MessageController@index')
        ->name('admin.message.index');

    // Create a new one
    Route::get('message/add', 'MessageController@create')
        ->name('admin.message.create');
    Route::post('message/add/{id}', 'MessageController@store')
        ->name('admin.message.store');

    // Show details
    Route::get('message/view/{id}', 'MessageController@show')
        ->name('admin.message.show');

    // Edit
    Route::get('message/edit/{id}', 'MessageController@edit')
        ->name('admin.message.edit');
    Route::put('message/edit/{id}', 'MessageController@update')
        ->name('admin.message.update');

    // Delete
    Route::delete('message/delete/{id}', 'MessageController@delete')
        ->name('admin.message.delete');
});
