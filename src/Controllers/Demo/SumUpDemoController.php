<?php

namespace Mariojgt\Gateway\Controllers\Demo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Mariojgt\Gateway\Controllers\GocardlessController;
use Illuminate\Support\Str;
use Mariojgt\Gateway\Controllers\BraintreeController;
use Mariojgt\Gateway\Controllers\SumUpController;

class SumUpDemoController extends Controller
{
    /**
     * @return [blade view]
     */
    public function index()
    {
        return view('gateway::content.sumup.sumup');
    }

    public function pay(Request $request)
    {
        $sumUp = new SumUpController();
        $paymentItem = [
            "checkout_reference" => Str::random(10),
            "amount"             => 10,
            "currency"           => "GBP",
            "pay_to_email"       => "mariojgt2-test@sumup.com", // Note this is you email you use to login in the sumup
            "description"        => "Sample one-time payment"
        ];

        $checkout = $sumUp->createCheckout($paymentItem);

        // the payment card deatils
        $cardInfo = [
            'payment_type' => 'card',
            'card' => [
                'name'         => 'Dominik Biermann',
                'number'       => '4485618386833995',
                'expiry_month' => '05',
                'expiry_year'  => '20',
                'cvv'          => '257'
            ]
        ];

        $paymentInfo = $sumUp->makePayment($checkout['id'], $cardInfo);

        return view('gateway::content.sumup.responsePage', compact('paymentInfo'));
    }
}
