<?php

return [
    // If True Means users can acess the demo
    'demo_mode'       => true,

    // PAYPAL KEY
    'paypal_client_id'          => env('PAYPAL_CLIENT_ID'),
    'paypal_secret'             => env('PAYPAL_SECRET'),
    // paypal log file location default storage/app/stripe_logs
    'paypal_log'                => '//paypal_logs//', // Login information
    'paypal_session_generate'   => '/paypal/generate/session',     // can be use to pregenerate a order
    'paypal_session_degenerate' => '/paypal/degenerate/session',   // can be use to rollback a order
    'paypal_complete'           => '/checkout/complete',           // can be use to rollback a order
    'paypal_live'               => false,                          // If enable transaction will be live

    // STRIPE KEY
    'stripe_secret'          => env('STRIPE_SECRET'),            // Secret
    'stripe_secret_public'   => env('STRIPE_SECRET_PUBLIC'),     // Public key
    'stripe_weebhook_secret' => env('STRIPE_WEEBHOOK_SECRET'),   // Weebhook key
    'stripe_log'             => '/stripe_logs',
    // Stripe Session Generate route
    'stripe_session_generate' => '/stripe_pay/session_generate',
    // Success Url
    'success_url' => 'https://yoururl.com/success',
    // Cancel Url
    'cancel_url' => 'https://yoururl.com/cancel',
    // Currency we goin to use to be Process in the cart
    'currency'   => 'GBP',
    // If false you weebhooks wont work
    'stripe_weebhook_enable' => true,

    // GO CARDLESS KEY
    'gc_live'                            => false,
    'gc_access_token'                    => env('GC_ACCESS_TOKEN'),
    'gocardless_webhook_endpoint_secret' => env('GOCARDLESS_WEBHOOK_ENDPOINT_SECRET'),
    'go_log'                             => '/gocardless_logs',
    'mandate_success'                    => env('GC_MANDATE_SUCCESS_PAGE') ?? 'success.mandate',
    // If false you weebhooks wont work
    'gocardless_weebhook_enable' => true,

    // BRAINTREE
    'braintree_environment' => env('BRAINTREE_ENVIRONMENT'),
    'braintree_merchantId'  => env('BRAINTREE_MERCHANTID'),
    'braintree_publicKey'   => env('BRAINTREE_PUBLICKEY'),
    'braintree_privateKey'  => env('BRAINTREE_PRIVATEKEY'),
    'braintree_log'         => '/braintree_logs',
];
