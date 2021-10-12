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
            "checkout_reference" => "CCTPNDZ6",
            "amount"             => 10,
            "currency"           => "GBP",
            "pay_to_email"       => "docuser@sumup.com",
            "description"        => "Sample one-time payment"
        ];

        dd($sumUp->createCheckout($paymentItem));
        dd(Request()->all());
    }
}
