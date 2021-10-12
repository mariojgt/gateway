<?php

use Illuminate\Support\Facades\Route;
use Mariojgt\Gateway\Controllers\GocardlessController;

// Gocardless weebhooks
Route::group([
    'middleware' => ['web'],
], function () {
    // Gocardless webhooks
    Route::any('/gocardless/weebhook', [GocardlessController::class, 'webhookManager'])
        ->name('gocardless.weebhook');
});
