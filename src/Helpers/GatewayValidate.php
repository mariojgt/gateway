<?php
namespace mariojgt\gateway\Helpers;

use Cache;

class GatewayValidate
{
    public static function validateStripe($stripeSessionId)
    {
        if (Cache::get($stripeSessionId)) {
            return true;
        } else {
            return false;
        }
    }
}
