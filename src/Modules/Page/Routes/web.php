<?php
Route::group(array(
    'namespace'  => 'mariojgt\checkout\Modules\Page\Controllers',
    'middleware' => ['web'],
    'prefix'     => ''
), function () {
    // Index file / list
    Route::get('page', 'PageController@index')
        ->name('admin.page.index');

    // Create a new one
    Route::get('page/add', 'PageController@create')
        ->name('admin.page.create');
    Route::post('page/add/{id}', 'PageController@store')
        ->name('admin.page.store');

    // Show details
    Route::get('page/view/{id}', 'PageController@show')
        ->name('admin.page.show');

    // Edit
    Route::get('page/edit/{id}', 'PageController@edit')
        ->name('admin.page.edit');
    Route::put('page/edit/{id}', 'PageController@update')
        ->name('admin.page.update');

    // Delete
    Route::delete('page/delete/{id}', 'PageController@delete')
        ->name('admin.page.delete');
});
