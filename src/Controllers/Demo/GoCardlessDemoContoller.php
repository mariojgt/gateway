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
        return view('gateway::content.gocardless');
    }

    public function debitGenerate(Request $request)
    {
        $user = [
        'given_name'    => Request('first_name'),
        'family_name'   => Request('last_name'),
        'email'         => Request('email'),
        'address_line1' => Request('address'),
        'city'          => Request('city'),
        'postal_code'   => Request('post_code'),
        ];

        Session::put('go_card', Str::uuid());

        $card         = new GocardlessController();
        $objectReturn = $card->setupDirectDebit($user);

        // Return a stripe session so we can use in the front end to redirect the user
        return response()->json([
            'data' => $objectReturn->redirect_url
        ]);
    }
}
