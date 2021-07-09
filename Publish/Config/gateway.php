<?php

return [
    // Paypal key
    'paypal_client_id' => env('PAYPAL_CLIENT_ID'),
    'paypal_secret'    => env('PAYPAL_SECRET'),
    'paypal_live'      => false, // If enable transaction will be live

    // Stripe key
    'stripe_secret'        => env('STRIPE_SECRET'),
    'stripe_secret_public' => env('STRIPE_SECRET_PUBLIC'),
    'stripe_log' => '/stripe_logs',
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
