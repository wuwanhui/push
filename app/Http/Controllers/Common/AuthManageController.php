<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

/**
 * 管理员认证
 * @package App\Http\Controllers\
 */
class AuthManageController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/manage';

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('manage.auth.login');
    }

    public function guard()
    {
        return Auth::guard('manage');
    }
}
