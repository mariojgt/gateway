<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Storage;
use App\Events\StripeUserPaymentSuccessEvent;

class StripeUserPaymentSuccessListener
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
     * @param StripeUserPaymentSuccessEvent $event
     *
     * @return void
     */
    public function handle(StripeUserPaymentSuccessEvent $event)
    {
        // customize for your needs
        $LogFileName = $event->invoiceObject->id . '_stripe_payment_sucess.log';
        Storage::put(config('gateway.stripe_log') . '/' . $LogFileName, json_encode($event->invoiceObject));
    }
}
