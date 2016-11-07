<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * 管理员认证
 * @package App\Http\Controllers\
 */
class ManageLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/manage';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * 登录
     */
    public function showLoginForm()
    {
        return view('auth.manage.login');
    }

    /**
     * 退出
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/auth/manage/login');
    }


    public function guard()
    {
        return Auth::guard('manage');
    }
}
