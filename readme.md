![image info](https://raw.githubusercontent.com/mariojgt/gateway/main/Publish/Art/logo.png)

# Laravel Gateway laravel 9 compatible

#composer require mariojgt/gateway

This is a Laravel package design to make checkout easy and clean to implement, avaliable integration (Stripe), in the future we going to have some more integrations with others gateways, the paypal is almost there

## How to use

In you blade file do the following

1. <x-gateway::pay_stripe /> This component will add all the javascript methods so we can generate a session and redirect the user.

2. On you button you need to add this method RegenerateSessionAndRedirect

   ```html
    <button onclick="RegenerateSessionAndRedirect()"
   	Pay with Stripe Example
   </button>
   ```

   This method will send a request back to your server and generate a key so we can use in the javascript checkout.

3. in the config file you have the key stripe_session_generate you need to point that to one of your laravel controler, you can use get or post for this.

4. Use this example code to generate you session

   ```php
   use Mariojgt\Gateway\Controllers\StripeContoller;

   public function sessionGenerate(Request $request)
       {
           // Start the stripe class
           $stipeManager = new StripeContoller();
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

   This code will return a json session that we can use in the javascript

5. You Can also check the session status using

```php
use Mariojgt\Gateway\Controllers\StripeContoller;
$stipeManager = new StripeContoller();
$session      = $stipeManager->checkSession('Session_id');

```

This will return the session information and the payment information.



Notes:

In Production disable the website demo buy changing the key value demo_mode to false in the gateway config file.
