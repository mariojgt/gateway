<?php
Route::group(array(
    'namespace'  => 'mariojgt\checkout\Modules\Backup\Controllers',
    'middleware' => ['web'],
    'prefix'     => config('checkout.admindir')
), function () {
    // Index file / list
    Route::get('backup', 'BackupController@index')
        ->name('admin.backup.index');

    // Create a new one
    Route::get('backup/add/{table?}', 'BackupController@create')
        ->name('admin.backup.create');
    Route::post('backup/add/{id}', 'BackupController@store')
        ->name('admin.backup.store');

    // Show details
    Route::get('backup/view/{id}', 'BackupController@show')
        ->name('admin.backup.show');

    // Edit
    Route::get('backup/edit/{id}', 'BackupController@edit')
        ->name('admin.backup.edit');
    Route::put('backup/edit/{id}', 'BackupController@update')
        ->name('admin.backup.update');

    // Delete
    Route::delete('backup/delete/{id}', 'BackupController@delete')
        ->name('admin.backup.delete');
});
