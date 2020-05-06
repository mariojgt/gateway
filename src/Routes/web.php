<?php
Route::group(array(
    'namespace'  => 'mariojgt\checkout\Controllers',
    //'middleware' => ['web', 'CheckAuth'],
    'prefix'     => 'checkout' //config('checkout.admindir')
), function () {
    //index
    Route::get('checkout', 'checkout\checkoutController@index')->name('checkout');
});
