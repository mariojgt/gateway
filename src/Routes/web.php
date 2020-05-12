<?php
Route::group(array(
    'namespace'  => 'mariojgt\gateway\Controllers',
    //'middleware' => ['web', 'CheckAuth'],
    'prefix'     => 'gateway' //config('gateway.admindir')
), function () {
    //index
    Route::get('stripe', 'gateway\StripeController@index')->name('stripe');
});
