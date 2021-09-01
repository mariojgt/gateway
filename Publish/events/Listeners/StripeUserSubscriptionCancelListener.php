<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Mariojgt\Onixserver\Models\OnixKey;
use App\Events\StripeUserSubscriptionCancelEvent;

class StripeUserSubscriptionCancelListener
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
     * @param StripeUserSubscriptionCancelEvent $event
     *
     * @return void
     */
    public function handle(StripeUserSubscriptionCancelEvent $event)
    {
        // customize for your needs
        $LogFileName = $event->subscrptionObject->subscription . '_cancel_fail.log';
            Storage::put(config('gateway.stripe_log') . $LogFileName, $event->subscrptionObject);
    }
}
