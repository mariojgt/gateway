<?php

namespace Mariojgt\Gateway\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Braintree\Gateway;

class BraintreeGatewayContoller extends Controller
{
    protected $gateway;

    public function __construct()
    {
        $environment = config('gateway.braintree_environment');
        $merchantId  = config('gateway.braintree_merchantId');
        $publicKey   = config('gateway.braintree_publicKey');
        $privateKey  = config('gateway.braintree_privateKey');

        $this->gateway = new Gateway([
            'environment' => $environment,
            'merchantId'  => $merchantId,
            'publicKey'   => $publicKey,
            'privateKey'  => $privateKey,
        ]);
    }


    public function index()
    {
        // Generate the client id
        $clientId = $this->gateway->clientToken()->generate();
        return view('gateway::content.braintree.index', compact('clientId'));
    }

    public function pay(Request $request)
    {
        // Customer submitted payment information
        // Take payment, get $result of transaction
        $result = $this->gateway->transaction()->sale([
            'amount'             => '10.00',
            'paymentMethodNonce' => Request('payment_method_nonce'),
            'deviceData'         => Request('client_data'),
            'options'            => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            dd($result->transaction);
        } else {
            dd($result->errors->deepAll());
        }
    }
}
