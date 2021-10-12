<?php

namespace Mariojgt\Gateway\Controllers\Demo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Mariojgt\Gateway\Controllers\GocardlessController;
use Illuminate\Support\Str;

class GoCardlessDemoContoller extends Controller
{
    /**
     * @return [blade view]
     */
    public function index()
    {
        return view('gateway::content.gocardless.gocardless');
    }

    /**
     * Redirect the user to the gocardless page so him can add his back information
     *
     * @param Request $request
     *
     * @return [type]
     */
    public function debitGenerate(Request $request)
    {
        // User array
        $user = [
            'given_name'    => Request('first_name'),
            'family_name'   => Request('last_name'),
            'email'         => Request('email'),
            'address_line1' => Request('address'),
            'city'          => Request('city'),
            'postal_code'   => Request('post_code'),
        ];

        // You need this later to confirm the user payment status
        Session::put('go_card', Str::uuid());
        // Go cardless api
        $card         = new GocardlessController();
        $objectReturn = $card->createFlow($user);

        // Return a stripe session so we can use in the front end to redirect the user
        return response()->json([
            'data' => $objectReturn->redirect_url
        ]);
    }

    /**
     * Confirm the flow mandate and create a paymant example
     * Note that when you complete the flow you can store that id to autorize payments and subscprtions
     *
     * @param Request $request
     *
     * @return [type]
     */
    public function mandateSuccess(Request $request)
    {
        $card        = new GocardlessController();
        // Get the flow information
        $getFlowInfo = $card->getFlow(Request('redirect_flow_id'));
        // Complete the flow
        $completeFlow = $card->completeFlow(Request('redirect_flow_id'), Session::get('go_card'));
        // Create the payment after complete the flow
        $payment      = $card->createPayment(100, 'GBP', $completeFlow->links->mandate);
        // Need information
        // $completeFlow->links->creditor
        // $completeFlow->links->mandate
        // $completeFlow->links->customer
        // $completeFlow->links->customer_bank_account
        return view('gateway::content.gocardless.gocardless_success', compact('completeFlow', 'payment'));
    }
}
