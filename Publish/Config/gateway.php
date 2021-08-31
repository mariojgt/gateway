<?php

return [
    // Paypal key
    'paypal_client_id'          => env('PAYPAL_CLIENT_ID'),
    'paypal_secret'             => env('PAYPAL_SECRET'),
    // paypal log file location default storage/app/stripe_logs
    'paypal_log'                => '//paypal_logs//',
    'paypal_session_generate'   => '/paypal/generate/session',     // can be use to pregenerate a order
    'paypal_session_degenerate' => '/paypal/degenerate/session',   // can be use to rollback a order
    'paypal_complete'           => '/checkout/complete',           // can be use to rollback a order
    'paypal_live'               => false,                          // If enable transaction will be live

    // Stripe key
    'stripe_secret'          => env('STRIPE_SECRET'),
    'stripe_secret_public'   => env('STRIPE_SECRET_PUBLIC'),
    'stripe_weebhook_secret' => env('STRIPE_WEEBHOOK_SECRET'),
    'stripe_log'             => '/stripe_logs',
    // Stripe Session Generate route
    'stripe_session_generate' => '/stripe_pay/session_generate',
    // Success Url
    'success_url' => 'https://yoururl.com/success',
    // Cancel Url
    'cancel_url' => 'https://yoururl.com/cancel',
    // Currency we goin to use to be Process in the cart
    'currency'   => 'GBP',
    // If True Means users can acess the demo
    'demo_mode' => true
];
