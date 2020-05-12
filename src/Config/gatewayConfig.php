<?php

return [
    //stripe keys
    'stripe_api'            => env('STRIPE_API', ''),
    'stripe_secret'         => env('STRIPE_SECRET', ''),
    'stripe_currency'       => env('STRIPE_CURRENCY', ''),
    'success_redirect'      => 'gateway/stripe/success',
    'error_redirect'        => 'gateway/stripe/error',
    'site_success_redirect' => env('STRIPE_SUCCESS', ''),
    'site_error_redirect'   => env('STRIPE_ERROR', ''),
];
