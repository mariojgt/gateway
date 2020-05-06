<?php
Route::group(array(
    'namespace'  => 'DummyNamespace\Modules\DummyModuleName\Controllers',
    'middleware' => ['web'],
    'prefix'     => ''
), function () {
    // Index file / list
    Route::get('DummyModuleNameLower', 'DummyModuleNameController@index')
        ->name('DummyRouteName.DummyModuleNameLower.index');

    // Create a new one
    Route::get('DummyModuleNameLower/add', 'DummyModuleNameController@create')
        ->name('DummyRouteName.DummyModuleNameLower.create');
    Route::post('DummyModuleNameLower/add', 'DummyModuleNameController@store')
        ->name('DummyRouteName.DummyModuleNameLower.store');
    
    // Show details
    Route::get('DummyModuleNameLower/view/{id}', 'DummyModuleNameController@show')
        ->name('DummyRouteName.DummyModuleNameLower.show');
    
    // Edit
    Route::get('DummyModuleNameLower/edit/{id}', 'DummyModuleNameController@edit')
        ->name('DummyRouteName.DummyModuleNameLower.edit');
    Route::put('DummyModuleNameLower/edit/{id}', 'DummyModuleNameController@update')
        ->name('DummyRouteName.DummyModuleNameLower.update');
    
    // Delete
    Route::delete('DummyModuleNameLower/delete/{id}', 'DummyModuleNameController@delete')
        ->name('DummyRouteName.DummyModuleNameLower.delete');
});
