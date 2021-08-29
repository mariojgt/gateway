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
        // Handle the cancelation here
        $key = OnixKey::where('subscription_ref', $event->subscrptionObject->subscription)->first();
        if (!empty($key)) {
            // Cancel the subscprtion
            $key->end_subscription = $key->expire_subscription;
            $key->save();

            // Check if the service still valid if not rever to the free
            if (!$key->end_subscription->greaterThan(Carbon::now())) {
                $key->components_downloads = 10;
                $key->pages_downloads      = 10;
                $key->uploads              = 5;
                $key->plan                 = 1; // free paln
                $key->end_subscription     = null;
                $key->expire_subscription  = Carbon::now()->addMonth(1);
                $key->save();
            }
        } else {
            // Create a log file for testing
            $LogFileName = $event->subscrptionObject->subscription . '_cancel_fail.log';
            Storage::put(config('gateway.stripe_log') . $LogFileName, $event->subscrptionObject);
        }
    }
}
