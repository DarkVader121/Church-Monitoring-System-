<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/login');
    }



    public function login(Request $request)
    {
        $this->validateLogin($request);
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        
        $username = $request->get($this->username());
        
        $user = User::where($this->username(), $username)->first();
        
        if (!$user) {
            return $this->sendFailedLoginResponse($request, 'The provided username is incorrect.');
        }
        
        if ($user && $user->disabled) {
            return $this->sendDisabledUserResponse($request);
        }
        
        $credentials = $this->credentials($request);
        
        if (!$this->attemptLogin($request)) {
            $this->incrementLoginAttempts($request);
            return $this->sendFailedLoginResponse($request, 'The provided password is incorrect.');
        }
        
        return $this->sendLoginResponse($request);
    }
    
        protected function sendFailedLoginResponse(Request $request, $message = 'The provided credentials are incorrect.')
    {
        $errors = [$this->username() => $message];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }

    protected function sendDisabledUserResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => 'Your account has been disabled.',
            ]);
    }

    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        return $credentials;
    }

     protected function authenticated(Request $request, $user)
     {
        if ($user->isAdmin()) {

            return redirect('/home');
        }

        if ($user->isParish()) {

            return redirect('/home/parish');
        } 

        if ($user->isCommissionHead()) {

            return redirect('/home/commission-head');
        }

        if ($user->isPpc()) {

            return redirect('/home/ppc');
        }

        if ($user->isPfc()) {

            return redirect('/home/pfc');
        }
     } 
}