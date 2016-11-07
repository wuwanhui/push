<?php

namespace App\Http\Controllers\Member;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends BaseController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.home');
    }

    public function home()
    {
        return view('member.home');
    }
}
