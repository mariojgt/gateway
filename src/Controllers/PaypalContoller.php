<?php

namespace Mariojgt\Gateway\Controllers;

use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use Stripe\StripeClient;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class PaypalContoller extends Controller
{
    public function __construct()
    {
        $this->paypal_client_id = config('gateway.paypal_client_id');
        $this->paypal_secret    = config('gateway.paypal_secret');

        if (config('gateway.paypal_live')) {
            $this->paypal_url = "https://api-m.paypal.com";
        } else {
            $this->paypal_url = "https://api-m.sandbox.paypal.com";
        }
    }

    /**
     * This function will return a session information and the payment intents information
     *
     * @param mixed $sessionId
     *
     * @return [array]
     */
    public function checkSession($paymentId)
    {
        // Get the order information
        $response = Http::withBasicAuth($this->paypal_client_id, $this->paypal_secret)->get($this->paypal_url . '/v2/checkout/orders/'.$paymentId, []);

        // Return the response
        if ($response->successful()) {
            return $response->json();
        } else {
            return false;
        }
    }
}
