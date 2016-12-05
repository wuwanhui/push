<?php

namespace App\Http\Controllers\Enterprise;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.enterprise');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('enterprise.home');
    }

    public function home()
    {
        return view('enterprise.home');
    }
}
