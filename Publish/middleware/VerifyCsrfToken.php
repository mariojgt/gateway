<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     * You need this for the weebhooks to work so the gateway can trigger the events
     * @var array
     */
    protected $except = [
        'stripe/*',
        'gocardless/*',
    ];
}
