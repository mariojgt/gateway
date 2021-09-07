<?php

use Illuminate\Support\Facades\Route;
use Mariojgt\Gateway\Controllers\StripeController;
use Mariojgt\Gateway\Controllers\Demo\GoogleDemoContoller;
use Mariojgt\Gateway\Controllers\Demo\PaypalDemoContoller;
use Mariojgt\Gateway\Controllers\Demo\StripeDemoContoller;
use Mariojgt\Gateway\Controllers\Demo\GoCardlessDemoContoller;

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

        // Google Pay Example
        Route::get('/google_pay', [GoogleDemoContoller::class, 'index'])->name('google_pay');

        // Gocardless example
        Route::get('/gocardless_pay', [GoCardlessDemoContoller::class, 'index'])
            ->name('gocardless_pay');
        Route::post('/gocardless_pay/setup/debit', [GoCardlessDemoContoller::class, 'debitGenerate'])
            ->name('gocardless_pay.setup.debit');
        // Redirect example after sucess
        Route::any('/mandate/success', [GoCardlessDemoContoller::class, 'mandateSuccess'])
            ->name('success.mandate');
    });
}


// Stripe weebhooks
if (config('gateway.weebhook_enable')) {
    Route::group([
        'middleware' => ['web'],
    ], function () {
        // Stripe webhooks
        Route::any('/stripe/weebhook', [StripeController::class, 'webhookManager'])
            ->name('stripe.weebhook');
    });
}
