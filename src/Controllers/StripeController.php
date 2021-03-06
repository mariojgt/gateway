<?php

namespace Mariojgt\Gateway\Controllers;

use Carbon\Carbon;
use Stripe\StripeClient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class StripeController extends Controller
{
    public function __construct()
    {
        // Start the string with the api key
        $this->stripe = new StripeClient(config('gateway.stripe_secret'));
    }

    /**
     * This fuction will transform a cart on a stripe session so we can redirect the user
     * @param mixed $cartItem
     *
     * @return StripeObject[]
     */
    public function process($cartItem)
    {
        // Example Cart Sturcture
        // [
        //     'name'        => 'kit kat',
        //     'description' => 'Kit kat product',
        //     'images'      => ['https://www.kitkat.com/images/main-logo-snap.png'],
        //     'amount'      => 2500,
        //     'currency'    => 'GBP',
        //     'quantity'    => 2,
        // ]
        // Call stripe session
        $stripeSession = $this->stripe->checkout->sessions->create([
            'success_url'          => url(config('gateway.success_url')),
            'cancel_url'           => url(config('gateway.cancel_url')),
            'payment_method_types' => ['card'],
            'line_items'           => $cartItem,
            'mode' => 'payment',
        ]);

        $this->createLog($stripeSession);

        return $stripeSession;
    }

    /**
     * This function will return a session information and the payment intents information
     *
     * @param mixed $sessionId
     *
     * @return [array]
     */
    public function checkSession($sessionId)
    {
        // Using the stripe session id to retrive the payment info
        // $session = $this->stripe->sessions->retrieve($sessionId);
        $session = $this->stripe->checkout->sessions->retrieve($sessionId);
        // Here we are using the payment intent to get the oder status and data
        $payment_status = $this->stripe->paymentIntents->retrieve($session->payment_intent);

        return [
            'session_info'   => $session,
            'payment_status' => $payment_status
        ];
    }

    /**
     * Create a stripe log file when the session has been created
     * @param mixed $data
     *
     */
    public function createLog($data)
    {
        $LogFileName = $data->id.'.log';
        Storage::put(config('gateway.stripe_log') . $LogFileName, json_encode($data));
    }
}
