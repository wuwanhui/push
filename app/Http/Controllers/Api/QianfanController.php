<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;

class QianfanController extends Controller
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
