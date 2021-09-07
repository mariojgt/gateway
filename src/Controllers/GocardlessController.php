<?php

namespace Mariojgt\Gateway\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


/**
 * [Example integration]
 */
class GocardlessController extends Controller
{
    public function __construct()
    {
        if (config('gateway.gc_live')) {
            $this->goCardless = new \GoCardlessPro\Client([
                // We recommend storing your access token in an
                // environment variable for security
                'access_token' => config('gateway.gc_access_token'),
                // Change me to LIVE when you're ready to go live
                'environment' => \GoCardlessPro\Environment::LIVE
            ]);
        } else {
            $this->goCardless = new \GoCardlessPro\Client([
                // We recommend storing your access token in an
                // environment variable for security
                'access_token' => config('gateway.gc_access_token'),
                // Change me to LIVE when you're ready to go live
                'environment' => \GoCardlessPro\Environment::SANDBOX
            ]);
        }
    }

    /**
     * List all avaliable customers
     *
     * @return [type]
     */
    public function customers()
    {
        return $this->goCardless->customers()->list()->records;
    }

    /**
     * Create a flow that redirect the user to the go cardless page and confirm the payment
     * @param mixed $user
     *
     * @return [type]
     */
    public function createFlow($user)
    {
        $redirectFlow = $this->goCardless->redirectFlows()->create([
            "params" => [
                // This will be shown on the payment pages
                "description" => "Wine boxes",
                // The reference that we can use later
                "session_token"        => Session::get('go_card'),
                "success_redirect_url" => route(config('gateway.mandate_success')),
                // Optionally, prefill customer details on the payment page
                "prefilled_customer" => [
                    "given_name"    => $user['given_name'],
                    "family_name"   => $user['family_name'],
                    "email"         => $user['email'],
                    "address_line1" => $user['address_line1'],
                    "city"          => $user['city'],
                    "postal_code"   => $user['postal_code']
                ]
            ]
        ]);

        // Store the session for future use
        Session::put('go_cardless_id', $redirectFlow->id);

        return $redirectFlow;
    }

    /**
     * Get basi information about the flow
     *
     * @param mixed $id
     *
     * @return [type]
     */
    public function getFlow($id)
    {
        return $this->goCardless->redirectFlows()->get($id);
    }

    /**
     * Complete the flow and return the customer id ,mandete and more.
     * @param mixed $id
     * @param mixed $session
     *
     * @return [type]
     */
    public function completeFlow($id, $session)
    {
        return $this->goCardless->redirectFlows()->complete($id, [
            "params" => ["session_token" => $session]
        ]);
    }

    /**
     * Create a paymant agains that user
     * @param mixed $amount
     * @param mixed $currency
     * @param mixed $mandate
     *
     * @return [type]
     */
    public function createPayment($amount, $currency, $mandate)
    {
        return $this->goCardless->payments()->create([
            "params" => [
                "amount" => $amount,
                "currency" => $currency,
                "metadata" => [
                    "order_dispatch_date" => "2016-08-04"
                ],
                "links" => [
                    "mandate" => $mandate
                ]
            ]
        ]);
    }

    /**
     * Create a stripe log file when the session has been created
     * @param mixed $data
     *
     */
    public function createLog($data)
    {
        $LogFileName = $data->id . '.log';
        Storage::put(config('gateway.go_log') . $LogFileName, json_encode($data));
    }
}
