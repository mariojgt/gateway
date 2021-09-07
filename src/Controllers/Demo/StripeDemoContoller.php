<?php

namespace Mariojgt\Gateway\Controllers\Demo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\StripeUserPaymentSuccessEvent;
use Mariojgt\Gateway\Controllers\StripeController;

class StripeDemoContoller extends Controller
{
    /**
     * @return [blade view]
     */
    public function index()
    {
        $paymentIntent = 234234324;
        StripeUserPaymentSuccessEvent::dispatch($paymentIntent);
        return view('gateway::content.stripe.index');
    }

    public function sessionGenerate(Request $request)
    {
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
}
