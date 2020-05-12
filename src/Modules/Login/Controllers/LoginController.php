<?php

namespace mariojgt\gateway\Modules\Login\Controllers;

use App\Http\Controllers\Controller;
use mariojgt\gateway\Modules\Login\Models\Login;

use App\Http\Requests;
use Auth;
use Password;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('gateway.login::index');
    }

        /**
         * Show the form for creating a new resource.
         *
         * @return Response
         */
    public function authenticate(Request $request)
    {
        // validate data
        $this->validate($request, [
            'username'  => 'required',
            'password'  => 'required|min:6'
        ]);

        if (filter_var($request->username, FILTER_VALIDATE_EMAIL)) {
            // check if email exists and is not suspended
            $credentials = array(
                'email'     => $request->username,
                'password'  => $request->password,
                'status'    => 1
            );
        } else {
            // check if username exists and is not suspended
            $credentials = array(
                'username'  => $request->username,
                'password'  => $request->password,
                'status'    => 1
            );
        }

        // Attempt to login with htose credentials
        if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
            // passed auth check

            // log creation
            $log = new \mariojgt\gateway\Models\Log();
            $log->user_id   = Auth::guard('admin')->id();
            $log->action    = 'Login';
            $log->model     = 'Admin';
            $log->content   = json_encode([
                'id' => Auth::guard('admin')->id(),
                'name' => Auth::guard('admin')->user()->name.' '.Auth::guard('admin')->user()->surname,
                'ip' => $_SERVER['REMOTE_ADDR']
            ]);
            $log->save();

            // head to dashboard
            $message['type']    = 'success';
            $message['message'] = 'Welcome Back '.Auth::guard('admin')->user()->name;

            // redirect to dashboard
            return redirect()
                ->intended(route('admin.dashboard'))
                ->withMessage($message);
        }

        // failed - return to login
        $message['type']    = 'warning';
        $message['message'] = 'Incorrect Username/Email/Password combination.';

        return redirect()->back()
            ->with(compact('message'))
            ->withInput($request->only('username', 'remember'));
    }

    public function showResetForm()
    {
        return view("Login::reset");
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        $message = [
            'type' => 'success',
            'message' => 'You have been successfully signed out.'
        ];
        return redirect()->route('admin.login')->withMessage($message);
    }

    /**
     * Determine if the user has too many failed login attempts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function hasTooManyLoginAttempts(Request $request)
    {
        $attempts = 5;
        $lockoutMinites = 10;
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request),
            $attempts,
            $lockoutMinites
        );
    }
}
