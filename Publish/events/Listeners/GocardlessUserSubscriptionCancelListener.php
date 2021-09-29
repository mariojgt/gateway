<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Storage;
use App\Events\GocardlessUserSubscriptionCancelEvent;

class GocardlessUserSubscriptionCancelListener
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
     * @param GocardlessUserSubscriptionCancelEvent $event
     *
     * @return void
     */
    public function handle(GocardlessUserSubscriptionCancelEvent $event)
    {
        // Find that user key so we can update the subscription
        $LogFileName = $event->subscription->id . 'subscription_cancelEvent.log';
        Storage::put(config('gateway.go_log'). '/' . $LogFileName, $event->subscription->links->subscription);
    }
}
