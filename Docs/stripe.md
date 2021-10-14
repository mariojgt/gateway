# Stripe integration

The stripe integration after you install the the gateway package you can access the following url /stripe_pay out of the box you have a example how it works, there is a couple of things you have to add in order to be able to take payments or test the demo.

## 1:.env file you need to add your testing or live keys so stripe can connect and you can test

```
STRIPE_SECRET="key in here"
STRIPE_SECRET_PUBLIC="key in here"
STRIPE_WEEBHOOK_SECRET="key in here" note that this key id not requied only if you wish to use weebhook
```

## 2:gateway.php in this file you have the stripe section where you can define the folder where you logs will be create by default inside the folder /storage/app/stripe_logs

```php
    // STRIPE KEY
    'stripe_secret'          => env('STRIPE_SECRET'),            // Secret comes from the .env file
    'stripe_secret_public'   => env('STRIPE_SECRET_PUBLIC'),     // Public key comes from the .env file
    'stripe_weebhook_secret' => env('STRIPE_WEEBHOOK_SECRET'),   // Weebhook key comes from the .env file
    'stripe_log'             => '/stripe_logs',
    // this is where you aplication will do a request so the droppin will generate a session id based in you card more info next block
    'stripe_session_generate' => '/stripe_pay/session_generate',
    // Success Url
    'success_url' => 'https://yoururl.com/success',
    // Cancel Url
    'cancel_url' => 'https://yoururl.com/cancel',
    // Currency we goin to use to be Process in the cart
    'currency'   => 'GBP',
    // If false you weebhooks wont work
    'stripe_weebhook_enable' => true,
```

## 3:stripe_session_generate this config file is where your function will request the order payment information and return a url that stripe will redirect the user make sure you have your success_url and cancel_url ready to handle the response, example how you can generate a session.

```php
/**
     * This Fuction will generate a session with the payment information live value and etc
     * so the dropping will redirect the user to stripe so we can complete the order
     * @param Request $request
     *
     * @return [type]
     */
    public function sessionGenerate(Request $request)
    {
	    //use Mariojgt\Gateway\Controllers\StripeController;
        // Start the stripe class
        $stipeManager = new StripeController();
        // Cart example, you Must folow this stucture
        $cartItem = [
            [
                'name'        => 'kit kat',
                'description' => 'Kit kat product',
                'images'      => ['https://www.kitkat.com/images/main-logo-snap.png'],
                'amount'      => 500, // Amount in pence value * 100
                'currency'    => config('gateway.currency'),
                'quantity'    => 2,
            ],
        ];
        // Send the cart item so stripe can create a valid session
        $session      = $stipeManager->process($cartItem);
        // Return a stripe session so we can use in the front end to redirect the user
        return response()->json([
            'session' => $session->id,
        ]);
    }
```

by default or component <x-gateway::pay_stripe /> it will handle this response be redirecting the user to the checkout page if you have all the config is correct setup in the .env file.

## 4:sucess or error handle you need to create a page that will check the stipe session that comes with the response has been paid if yes then you can mark the order as paid, quick example bellow

```php
			   // Start the stripe class
                $stipeManager = new StripeController();
                // Send the cart item so stripe can create a valid session
                $session= $stipeManager->checkSession($orderIndentification); // order indentification is what comes back from stripe
                if ($session['payment_status']->status == 'succeeded') {
                    return true;
                } else {
                    return false;
                }
```

# Extra weebhooks: by default we handle the following events

customer.subscription.deleted
customer.subscription.trial_will_end
invoice.payment_succeeded
invoice.paid
customer.subscription.created
customer.subscription.updated

#### to use the weebhooks you in the gateway you need to set the gateway config file stripe_weebhook_enable to true if not using set as false as may take some resources, to change the logic inside you can change the following files  inside this folder that start with stripe app/Listeners they are events trigger by the package.

Notes all this integration is available in the demo, if you not using the demo please don;t forget to disable for security reasons.