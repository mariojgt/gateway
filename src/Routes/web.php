<?php

use Illuminate\Support\Facades\Route;
use Mariojgt\Gateway\Controllers\DemoContoller;

if (config('gateway.demo_mode')) {
    // Demo
    Route::group([
        'middleware' => ['web']
    ], function () {
        // Example Stripe payment
        Route::get('/stripe_pay', [DemoContoller::class, 'index'])->name('stripe_pay');
        // Example Stripe Generate a session
        Route::any('/stripe_pay/session_generate', [DemoContoller::class, 'sessionGenerate'])
            ->name('stripe_pay.session_generate');
    });
}
