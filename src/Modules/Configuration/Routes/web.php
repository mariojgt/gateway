<?php
Route::group(array(
    'namespace'  => 'mariojgt\checkout\Modules\Configuration\Controllers',
    'middleware' => ['web'],
    'prefix'     => config('checkout.admindir')
), function () {
    // Index file / list
    Route::get('configuration', 'ConfigurationController@index')
        ->name('admin.configuration.index');

    // Create a new one
    Route::get('configuration/add', 'ConfigurationController@create')
        ->name('admin.configuration.create');
    Route::post('configuration/add', 'ConfigurationController@store')
        ->name('admin.configuration.store');

    // Show details
    Route::get('configuration/view/{id}', 'ConfigurationController@show')
        ->name('admin.configuration.show');

    // Edit
    Route::get('configuration/edit/{id}', 'ConfigurationController@edit')
        ->name('admin.configuration.edit');
    Route::put('configuration/edit', 'ConfigurationController@update')
        ->name('admin.configuration.update');

    // Delete
    Route::delete('configuration/delete/{id}', 'ConfigurationController@delete')
        ->name('admin.configuration.delete');
});
