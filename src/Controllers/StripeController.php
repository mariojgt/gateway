<?php

namespace Mariojgt\Gateway\Controllers;

use Carbon\Carbon;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Events\StripeUserPaymentSuccessEvent;
use App\Events\StripeUserSubscriptionCancelEvent;
use App\Events\StripeUserSubscriptionSuccessEvent;


/**
 * This Controller comes with the basic for a checkout out of the box
 * More fuction you need to extend and implement for you needs
 */
class StripeController extends Controller
{
    public function __construct()
    {
        // Start the string with the api key
        $this->stripe = new StripeClient(config('gateway.stripe_secret'));
    }

    /**
     * This fuction will transform a cart on a stripe session so we can redirect the user
     * @param mixed $cartItem
     *
     * @return StripeObject[]
     */
    public function process($cartItem)
    {
        // More information
        // https://stripe.com/docs/api/checkout/sessions/create?lang=php
        // Example Cart Sturcture
        // [
        //     'name'        => 'kit kat',
        //     'description' => 'Kit kat product',
        //     'images'      => ['https://www.kitkat.com/images/main-logo-snap.png'],
        //     'amount'      => 2500,
        //     'currency'    => 'GBP',
        //     'quantity'    => 2,
        // ]

        // Create a fall back in case we update and don't publish the cart
        $paymentsMethods = ['card'];
        if (empty(config('gateway.stripe_payment_method_types'))) {
            $paymentsMethods = ['card'];
        } else {
            $paymentsMethods = config('gateway.stripe_payment_method_types');
        }

        // Call stripe session
        $stripeSession = $this->stripe->checkout->sessions->create([
            'success_url'          => url(config('gateway.success_url')),
            'cancel_url'           => url(config('gateway.cancel_url')),
            'payment_method_types' => ['card'],
            'line_items'           => $cartItem,
            'mode'                 => 'payment',
            // Payment mthod you want to use
            'payment_method_types' => $paymentsMethods,
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
        // Weebhook secret goes here
        $endpoint_secret = config('gateway.stripe_weebhook_secret');
        $payload         = @file_get_contents('php://input');
        $sig_header      = $_SERVER['HTTP_STRIPE_SIGNATURE'];

        // Make sure it has a valid response
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

        // Handle the event note the those are the event name in the stripe weebhooks
        switch ($event->type) {
                // Cancel subscrption
            case 'customer.subscription.deleted':
                // Trigger a event that will handle that
                $subscriptionSchedule = $event->data->object;
                StripeUserSubscriptionCancelEvent::dispatch($subscriptionSchedule);
            case 'customer.subscription.trial_will_end':
                // Trigger a event that will handle that
                $subscriptionSchedule = $event->data->object;
                StripeUserSubscriptionCancelEvent::dispatch($subscriptionSchedule);
            case 'invoice.payment_succeeded':
                $paymentIntent  = $event->data->object;
                StripeUserPaymentSuccessEvent::dispatch($paymentIntent);
            case 'invoice.paid':
                $paymentIntent  = $event->data->object;
                StripeUserPaymentSuccessEvent::dispatch($paymentIntent);
            case 'customer.subscription.created':
                $subscriptionSchedule = $event->data->object;
                StripeUserSubscriptionSuccessEvent::dispatch($subscriptionSchedule);
            case 'customer.subscription.updated':
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
