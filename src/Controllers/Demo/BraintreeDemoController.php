<?php

namespace Mariojgt\Gateway\Controllers\Demo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Mariojgt\Gateway\Controllers\GocardlessController;
use Illuminate\Support\Str;
use Mariojgt\Gateway\Controllers\BraintreeController;

class BraintreeDemoController extends Controller
{
    /**
     * @return [blade view]
     */
    public function index()
    {
        return view('gateway::content.braintree.braintree');
    }

    public function makePayment(Request $request)
    {
        // Start the braintree helper that contains all the required logic to create payments
        $braintreeController = new BraintreeController();

        // Example payment array
        $paymentExample = [
            'amount'             => 20.21, // Amount you wish to pay
            'paymentMethodNonce' => Request('payment_method_nonce'), // Generate by the droppin
            'customer'           => [
                'firstName' => Request('first_name'),
                'lastName'  => Request('last_name'),
                'company'   => 'Company name here',
                'phone'     => '99999999',
                'fax'       => '99999999',
                'email'     => Request('email'),
            ],
            'billing' => [
                'firstName'         => Request('first_name'),
                'lastName'          => Request('last_name'),
                'company'   => 'Company name here',
                'streetAddress'     => Request('address'),
                'extendedAddress'   => Request('address'),
                'locality'          => Request('city'),
                'region'            => Request('city'),
                'postalCode'        => 'SE43ST',
                'countryCodeAlpha2' => 'GB',
            ],
            // 'shipping' => [
            //     'firstName'         => $orderInfo['user']->first_name,
            //     'lastName'          => $orderInfo['user']->last_name,
            //     'company'           => $orderInfo['company']->name ?? 'undefine',
            //     'streetAddress'     => $orderInfo['address']->address,
            //     'extendedAddress'   => $orderInfo['address']->address2,
            //     'locality'          => $orderInfo['address']->town,
            //     'region'            => $orderInfo['address']->county,
            //     'postalCode'        => $orderInfo['address']->postcode,
            //     'countryCodeAlpha2' => $orderInfo['address']->country->iso_code2
            // ],
            'options'            => [
                'submitForSettlement' => true
            ]
        ];
        // Try to pay the transaction
        $result = $braintreeController->payTransaction($paymentExample);

        dd($result, 'Example braintree payment');
    }
}
