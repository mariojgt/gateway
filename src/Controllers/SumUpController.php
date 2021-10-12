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
            'body' => json_encode($paymentInfo)
        ]);
        dd($response->json());
    }
}
