<?php

namespace App\Listeners;

use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Mariojgt\Onixserver\Models\OnixKey;
use App\Events\StripeUsePaymentSuccessEvent;

class StripeUsePaymentSuccessEventListener
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
     * @param StripeUsePaymentSuccessEvent $event
     *
     * @return void
     */
    public function handle(StripeUsePaymentSuccessEvent $event)
    {
        $LogFileName = $event->invoiceObject->id . '_invoice.log';
        Storage::put(config('gateway.stripe_log') . $LogFileName, json_encode($event->invoiceObject));
    }
}
