<?php

namespace Mariojgt\Gateway\Controllers\Demo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mariojgt\Gateway\Controllers\PaypalContoller;

class PaypalDemoContoller extends Controller
{
    /**
     * @return [blade view]
     */
    public function index()
    {
        return view('gateway::content.paypal.paypalIndex');
    }

    public function checkPayment(Request $request, $orderid)
    {
        // Start the paypal class
        $paypalManager = new PaypalContoller();
        $paypalInfo    = $paypalManager->checkSession($orderid);


        return response()->json([
            'data' => $paypalInfo,
        ]);
    }
}
