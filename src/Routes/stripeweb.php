<?php

use Illuminate\Support\Facades\Route;
use Mariojgt\Gateway\Controllers\StripeController;

// Stripe weebhooks
Route::group([
    'middleware' => ['web'],
], function () {
    // Stripe webhooks
    Route::any('/stripe/weebhook', [StripeController::class, 'webhookManager'])
        ->name('stripe.weebhook');
});
