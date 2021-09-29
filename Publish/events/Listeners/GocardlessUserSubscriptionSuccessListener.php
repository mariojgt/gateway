<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Storage;
use App\Events\GocardlessUserSubscriptionSuccessEvent;

class GocardlessUserSubscriptionSuccessListener
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
     * @param GocardlessUserSubscriptionSuccessEvent $event
     *
     * @return void
     */
    public function handle(GocardlessUserSubscriptionSuccessEvent $event)
    {
        // Find that user key so we can update the subscription
        $LogFileName = $event->subscription->id . 'subscription_successEvent.log';
        Storage::put(config('gateway.go_log') . '/' . $LogFileName, $event->subscription->links->subscription);
    }
}
