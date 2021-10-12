<?php

use Illuminate\Support\Facades\Route;
use Mariojgt\Gateway\Controllers\SumUpController;
use Mariojgt\Gateway\Controllers\Demo\PaypalDemoContoller;
use Mariojgt\Gateway\Controllers\Demo\StripeDemoContoller;
use Mariojgt\Gateway\Controllers\Demo\SumUpDemoController;
use Mariojgt\Gateway\Controllers\Demo\BraintreeDemoController;
use Mariojgt\Gateway\Controllers\Demo\GoCardlessDemoContoller;


// THOSE ROUTES HAVE ONLY THE PURPOSE DEMONSTRATION HOW THOSE INTEGRATIONS WORKS
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

    // Gocardless example
    Route::get('/gocardless_pay', [GoCardlessDemoContoller::class, 'index'])
        ->name('gocardless_pay');
    Route::post('/gocardless_pay/setup/debit', [GoCardlessDemoContoller::class, 'debitGenerate'])
        ->name('gocardless_pay.setup.debit');
    // Redirect example after sucess
    Route::any('/mandate/success', [GoCardlessDemoContoller::class, 'mandateSuccess'])
        ->name('success.mandate');

    // Braintree Example
    Route::get('/braintree', [BraintreeDemoController::class, 'index'])
        ->name('braintree');
    Route::post('/braintree/example/pay', [BraintreeDemoController::class, 'makePayment'])
        ->name('braintree.example.pay');

    // SumUp Example
    // Route::get('/sumup', [SumUpDemoController::class, 'index'])
    //     ->name('sumup');
    // Route::post('/sumup/pay', [SumUpDemoController::class, 'pay'])
    //     ->name('sumup.pay');
});
