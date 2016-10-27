<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use App\Models\Distribution;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 管理员认证
 * @package App\Http\Controllers\
 */
class AutoController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate()
    {
//        if (Auth::attempt(['email' => $email, 'password' => $password])) {
//            // Authentication passed...
//            return redirect()->intended('dashboard');
//        }
    }

}
