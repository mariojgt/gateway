<?php
    // The Gateway Config File
return [
    // Braintree gateway
    'braintree_environment'    => 'sandbox',
    'braintree_merchantId'     => 'use_your_merchant_id',
    'braintree_publicKey'      => 'use_your_public_key',
    'braintree_privateKey'     => 'use_your_private_key',

    // The return after the payment has complete
    'payment_return' => 'example'
];
