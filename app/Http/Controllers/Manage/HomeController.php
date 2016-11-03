<?php

namespace App\Http\Controllers\Manage;

class HomeController extends BaseController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage.home');
    }
}
