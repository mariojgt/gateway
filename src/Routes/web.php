<?php

use Illuminate\Support\Facades\Route;
use Mariojgt\Gateway\Controllers\Demo\PaypalDemoContoller;
use Mariojgt\Gateway\Controllers\Demo\StripeDemoContoller;

if (config('gateway.demo_mode')) {
    // Demo
    Route::group([
        'middleware' => ['web']
    ], function () {
        // Example Stripe payment
        Route::get('/stripe_pay', [StripeDemoContoller::class, 'index'])->name('stripe_pay');
        // Example Stripe Generate a session
        Route::any('/stripe_pay/session_generate', [StripeDemoContoller::class, 'sessionGenerate'])
            ->name('stripe_pay.session_generate');

        // Paypal example
        Route::get('/paypal_pay', [PaypalDemoContoller::class, 'index'])->name('paypal_pay');

        Route::get('/paypal/checkpayment/{orderid}', [PaypalDemoContoller::class, 'checkPayment'])
            ->name('paypal.checkpayment');
    });
}
