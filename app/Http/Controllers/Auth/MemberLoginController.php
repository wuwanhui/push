<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * 会员认证
 * @package App\Http\Controllers\
 */
class MemberLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/member';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * 登录
     */
    public function showLoginForm()
    {
        return view('auth.member.login');
    }

    /**
     * 退出
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/auth/member/login');
    }


    public function guard()
    {
        return Auth::guard('member');
    }
}
