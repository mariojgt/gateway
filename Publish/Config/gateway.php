<?php

return [
    // Stripe key
    'stripe_secret'        => env('STRIPE_SECRET'),
    'stripe_secret_public' => env('STRIPE_SECRET_PUBLIC'),
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
