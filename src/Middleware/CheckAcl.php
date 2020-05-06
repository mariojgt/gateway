<?php

namespace mariojgt\checkout\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAcl
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
        if (!Auth::guard('admin')->check() || !Auth::guard('admin')->isValid()) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
