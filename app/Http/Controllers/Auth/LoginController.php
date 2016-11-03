<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
//
//    public function authenticated(Request $request, $user)
//    {
//
////        if ($user->type == 0) {
////            Auth::guard('manage');
////        } else {
////            Auth::guard('member');
////        }
////
////        Log::info("authenticated");
////        return true;
//    }

//
//    public function guard()
//    {
//        Log::info("guard");
////        $email = Input::get('email');
////        v($email);
//        return Auth::guard('member');
//    }
}
