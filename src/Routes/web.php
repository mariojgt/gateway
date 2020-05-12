<?php
Route::group(array(
    'namespace'  => 'mariojgt\gateway\Controllers',
    //'middleware' => ['web', 'CheckAuth'],
    'prefix'     => 'gateway' //config('gateway.admindir')
), function () {
    //stripe
    Route::post('stripe', 'gateway\StripeController@process')->name('stripe');
    Route::get('stripe/success', 'gateway\StripeController@success')->name('stripe.success');
    Route::get('stripe/error', 'gateway\StripeController@error')->name('stripe.error');
});
