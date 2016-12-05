<?php

namespace App\Http\Controllers\Enterprise\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/enterprise';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:enterprise', ['except' => [
            'logout',
            'redirectToLogin',
        ]]);
    }

    public function showLoginForm()
    {
        return view('enterprise.auth.login');
    }

    public function redirectToLogin()
    {
        if ($this->guard('enterprise')->user()) {
            return redirect('/enterprise/');
        }

        return redirect('/enterprise/login');
    }

    protected function guard()
    {
        return Auth::guard('enterprise');
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/enterprise/login');
    }
}
