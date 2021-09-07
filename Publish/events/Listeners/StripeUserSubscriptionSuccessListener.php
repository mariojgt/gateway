<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Storage;
use App\Events\StripeUserSubscriptionSuccessEvent;

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
