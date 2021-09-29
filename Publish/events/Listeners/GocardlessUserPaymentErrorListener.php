<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Storage;
use App\Events\GocardlessUserPaymentErrorEvent;

class GocardlessUserPaymentErrorListener
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
     * @param GocardlessUserPaymentErrorEvent $event
     *
     * @return void
     */
    public function handle(GocardlessUserPaymentErrorEvent $event)
    {
        // Find that user key so we can update the subscription
        $LogFileName = $event->subscription->id . 'payment_error.log';
        Storage::put(config('gateway.go_log') . '/' . $LogFileName, $event->subscription->links->payment);
    }
}
