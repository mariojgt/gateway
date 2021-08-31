<?php

namespace Mariojgt\Gateway\Controllers;

use Carbon\Carbon;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Events\StripeUsePaymentSuccessEvent;
use App\Events\StripeUserSubscriptionCancelEvent;
use App\Events\StripeUserSubscriptionSuccessEvent;


class StripeController extends Controller
{
    public function __construct()
    {
        // Start the string with the api key
        $this->stripe = new StripeClient(config('gateway.stripe_weebhook_secret'));
    }

    /**
     * This fuction will transform a cart on a stripe session so we can redirect the user
     * @param mixed $cartItem
     *
     * @return StripeObject[]
     */
    public function process($cartItem)
    {
        // Example Cart Sturcture
        // [
        //     'name'        => 'kit kat',
        //     'description' => 'Kit kat product',
        //     'images'      => ['https://www.kitkat.com/images/main-logo-snap.png'],
        //     'amount'      => 2500,
        //     'currency'    => 'GBP',
        //     'quantity'    => 2,
        // ]
        // Call stripe session
        $stripeSession = $this->stripe->checkout->sessions->create([
            'success_url'          => url(config('gateway.success_url')),
            'cancel_url'           => url(config('gateway.cancel_url')),
            'payment_method_types' => ['card'],
            'line_items'           => $cartItem,
            'mode' => 'payment',
        ]);

        $this->createLog($stripeSession);

        return $stripeSession;
    }

    /**
     * This function will return a session information and the payment intents information
     *
     * @param mixed $sessionId
     *
     * @return [array]
     */
    public function checkSession($sessionId)
    {
        // Using the stripe session id to retrive the payment info
        // $session = $this->stripe->sessions->retrieve($sessionId);
        $session = $this->stripe->checkout->sessions->retrieve($sessionId);
        // Here we are using the payment intent to get the oder status and data
        $payment_status = $this->stripe->paymentIntents->retrieve($session->payment_intent);

        return [
            'session_info'   => $session,
            'payment_status' => $payment_status
        ];
    }

    /**
     * Handle stripe weebhook
     *
     * @param Request $request
     *
     * @return [type]
     */
    public function webhookManager(Request $request)
    {
        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        // $endpoint_secret = config('gateway.stripe_secret'); //live
        $endpoint_secret = 'whsec_kH9fWm0mgyWEfI4c8Oka247Jdy9ExTWi'; //test

        $payload    = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            http_response_code(401);
            exit();
        }

        // Handle the event
        switch ($event->type) {
                // Cancel subscrption
            case 'subscription_schedule.canceled':
                // Trigger a event that will handle that
                $subscriptionSchedule = $event->data->object;
                StripeUserSubscriptionCancelEvent::dispatch($subscriptionSchedule);
            case 'invoice.finalized':
                $paymentIntent  = $event->data->object;
                StripeUsePaymentSuccessEvent::dispatch($paymentIntent);
            case 'subscription_schedule.completed':
                $subscriptionSchedule = $event->data->object;
                StripeUserSubscriptionSuccessEvent::dispatch($subscriptionSchedule);
            case 'subscription_schedule.created':
                $subscriptionSchedule = $event->data->object;
                StripeUserSubscriptionSuccessEvent::dispatch($subscriptionSchedule);
            case 'subscription_schedule.released':
                $subscriptionSchedule = $event->data->object;
                StripeUserSubscriptionSuccessEvent::dispatch($subscriptionSchedule);
            case 'subscription_schedule.updated':
                $subscriptionSchedule = $event->data->object;
                StripeUserSubscriptionSuccessEvent::dispatch($subscriptionSchedule);
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        http_response_code(200);
    }

    /**
     * Create a stripe log file when the session has been created
     * @param mixed $data
     *
     */
    public function createLog($data)
    {
        $LogFileName = $data->id . '.log';
        Storage::put(config('gateway.stripe_log') . $LogFileName, json_encode($data));
    }
}
