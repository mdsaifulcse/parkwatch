<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |-----------------------------------------------------------
    | Login Controller
    |-----------------------------------------------------------
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
    protected $redirectTo = 'dashboard'; 

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     *
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if($user->hasRole('superadmin') || $user->hasRole('admin') || $user->hasRole('parkingowner'))
        {
            return redirect('admin/dashboard');
        } 
        elseif ($user->hasRole('operator')) {
            return redirect('operator/dashboard');
        }
    }


    /**
    * Determine if the user has too many failed login attempts.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return bool
    */

    protected function hasTooManyLoginAttempts(Request $request)
    {
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), 3, 1
        );
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');  
        Auth::logout();
    }


    public function logout(Request $request) 
    {
        Auth::logout();
        return redirect('/login');
    }


}
