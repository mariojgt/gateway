<?php
namespace mariojgt\gateway\Controllers\gateway;

//Laravel standard classes
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

// MODELS

class StripeController extends Controller
{

    public function __construct()
    {
        //loading the stripe key
        // Set your secret key. Remember to switch to your live secret key in production!
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey(config('gateway.stripe_api'));
    }

    public function process(Request $request)
    {
        $stripe_session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
            self::lineItems(Request()->all()),
        'success_url' =>env('APP_URL').config('gateway.success_redirect').'?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url'  =>env('APP_URL').config('gateway.error_redirect'),
        ]);

        //go tho the view and send the user to the checkout
        return view("gateway::Pages.stripe.index", compact('stripe_session'));
    }

    private function lineItems($request)
    {
        $line_items = [];
        //seting um the items
        foreach ($request['line_items_name'] as $key => $item) {
            //the product price must not have . or , and need to be a integer
            $finalProductPrice = round(decrypt($request['line_items_amount'][$key]) * 100);
            $temp = [
                    'name'        => $request['line_items_name'][$key],
                    'description' => $request['line_items_description'][$key],
                    'images'      => [$request['line_items_images'][$key]],
                    'amount'      => $finalProductPrice,
                    'currency'    => config('gateway.stripe_currency'),
                    'quantity'    => decrypt($request['line_items_quantity'][$key]),
            ];
            array_push($line_items, $temp);
        }
        //check if postage is not empty
        if (decrypt($request['postage_amount'][0]) != "0000" &&
            decrypt($request['postage_amount'][0]) != 0 &&
            !empty(decrypt($request['postage_amount'][0])) )
        {
            //adding the postage
            $tempPostage = [
                'name'        => $request['postage_name'][0],
                'description' => $request['postage_description'][0],
                'amount'      => decrypt($request['postage_amount'][0]),
                'currency'    => config('gateway.stripe_currency'),
                'quantity'    => decrypt($request['postage_quantity'][0]),
                ];
            array_push($line_items, $tempPostage);
        }

        if (!empty(decrypt($request['vat_amount'][0]))) {
            //adding the taxes
            $tempVat = [
                'name'        => $request['vat_name'][0],
                'description' => $request['vat_description'][0],
                'amount'      => decrypt($request['vat_amount'][0]),
                'currency'    => config('gateway.stripe_currency'),
                'quantity'    => decrypt($request['vat_quantity'][0]),
                ];
            array_push($line_items, $tempVat);
        }

        //creating the line items array that stripe will process for use the payment
        $line_items_final  = ['line_items' => [
            $line_items
        ]];

        return $line_items_final;
    }

    public function success(Request $request)
    {
        //using the stripe session id to retrive the payment info
        $session = \Stripe\Checkout\Session::retrieve(Request('session_id'));
        //here we are using the payment intent to get the oder status and data
        $payment_status = \Stripe\PaymentIntent::retrieve($session->payment_intent);

        $dataReturn = [
            "stripe_session"        => $session,
            "stripe_payment_status" => $payment_status,
        ];

        //return the user to the sucess page define in the config file
        return redirect()->route(config('gateway.site_success_redirect'), [
            'data'        => json_encode($dataReturn),
        ]);
    }

    public function error(Request $request)
    {
        //send teh user to the error page define in the /env file
        return redirect()->route(config('gateway.site_error_redirect'), []);
    }
}
