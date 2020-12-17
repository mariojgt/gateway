<?php

use Illuminate\Support\Facades\Route;
use Mariojgt\Gateway\Controllers\BraintreeGatewayContoller;

// Example Controller
Route::group([
    'middleware' => ['web']
], function () {
    // Load flick example view
    Route::get('/braintree', [BraintreeGatewayContoller::class , 'index'])->name('braintree');
    Route::post('/braintree/pay', [BraintreeGatewayContoller::class , 'pay'])->name('braintree.pay');
});
