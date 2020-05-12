<?php

return [
    //stripe keys
    'stripe_api'       => env('STRIPE_API', ''),
    'stripe_secret'    => env('STRIPE_SECRET', ''),
    'success_redirect' => env('STRIPE_SUCCESS', ''),
    'error_redirect'   => env('STRIPE_ERROR', ''),
];
