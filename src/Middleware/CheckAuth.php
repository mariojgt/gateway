<?php

namespace mariojgt\checkout\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAuth
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
        if (!Auth::guard('admin')->check()) {
            // setup an error message
            $message = [
                'status'  => 'warning',
                'message' => 'This page is restricted. Please Login.'
            ];
            // return to the login page
            return redirect()->route('admin.login')
                ->with(compact('message'));
        }

        if (Auth::guard('admin')->user()->status == 0) {
            // ensure user has been locked out
            Auth::guard('admin')->logout();
            // setup an error message
            $message = [
                'status'  => 'danger',
                'message' => 'Your account is currently suspended please contact an administrator.'
            ];
            // return to the login page
            return redirect()->route('admin.login')
                ->with(compact('message'));
        }

        return $next($request);
    }
}
