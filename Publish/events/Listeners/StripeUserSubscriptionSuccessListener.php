<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Mariojgt\Onixserver\Models\OnixKey;
use App\Events\StripeUserSubscriptionSuccessEvent;
use Mariojgt\Onixserver\Mail\PaymentSuccess;
use Mariojgt\Onixserver\Controllers\Gateway\GatewayController;

class StripeUserSubscriptionSuccessListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Send the user a link so we can verify the email.
     *
     * @param StripeUserSubscriptionSuccessEvent $event
     *
     * @return void
     */
    public function handle(StripeUserSubscriptionSuccessEvent $event)
    {
        // Find that user key so we can update the subscription
        $LogFileName = $event->subscription->subscription . 'subscprtion_error.log';
        Storage::put(config('gateway.stripe_log') . $LogFileName, json_encode($event->subscription));
    }
}
