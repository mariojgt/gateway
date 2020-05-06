<?php

namespace mariojgt\checkout\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckGuest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            $message = [
                'status'  => 'warning',
                'message' => 'You are already signed in.'
            ];
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
