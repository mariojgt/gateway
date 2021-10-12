<?php

namespace Mariojgt\Gateway\Controllers\Demo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mariojgt\Gateway\Controllers\StripeController;

class StripeDemoContoller extends Controller
{
    /**
     * @return [blade view]
     */
    public function index()
    {
        return view('gateway::content.stripe.index');
    }

    /**
     * This Fuction will generate a session with the payment information live value and etc
     * so the dropping will redirect the user to stripe so we can complete the order
     * @param Request $request
     *
     * @return [type]
     */
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
