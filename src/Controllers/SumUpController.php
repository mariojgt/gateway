<?php

namespace Mariojgt\Gateway\Controllers;

use DateTime;
use Carbon\Carbon;
use Braintree\Gateway;
use Stripe\StripeClient;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

/**
 * This Controller comes with the basic for a checkout out of the box
 * More fuction you need to extend and implement for you needs
 */
class SumUpController extends Controller
{
    /**
     * This Fuction will generate a Bearer Token so we can make payments with sumup gateway
     *
     * @return [type]
     */
    public function tokenBearerGenerate()
    {
        $response = Http::post('https://api.sumup.com/token', [
            'grant_type'    => 'client_credentials',
            'client_id'     => config('gateway.sumup_client_id'),
            'client_secret' => config('gateway.sumup_client_secret'),
        ]);

        return $response->json();
    }

    public function createCheckout($paymentInfo)
    {
        $token = $this->tokenBearerGenerate();
        $response = Http::withToken($token['access_token'])->post('https://api.sumup.com/v0.1/checkouts', [
            'checkout_reference' => $paymentInfo['checkout_reference'],
            'amount'             => $paymentInfo['amount'],
            'currency'           => $paymentInfo['currency'],
            'pay_to_email'       => $paymentInfo['pay_to_email'],
            'description'        => $paymentInfo['description'],
        ]);

        return $response->json();
    }

    public function makePayment($checkoutId, $cardInformation)
    {
        $token    = $this->tokenBearerGenerate();
        $response = Http::withToken($token['access_token'])->put('https://api.sumup.com/v0.1/checkouts/' . $checkoutId, [
            'payment_type' => $cardInformation['payment_type'],
            'card' => [
                'name'         => $cardInformation['card']['name'],
                'number'       => $cardInformation['card']['number'],
                'expiry_month' => $cardInformation['card']['expiry_month'],
                'expiry_year'  => $cardInformation['card']['expiry_year'],
                'cvv'          => $cardInformation['card']['cvv'],
            ]
        ]);

        return $response->json();
    }

    public function checkCheckout($checkoutId)
    {
        $token    = $this->tokenBearerGenerate();
        $response = Http::withToken($token['access_token'])->get('https://api.sumup.com/v0.1/checkouts/' . $checkoutId, []);

        return $response->json();
    }
}
