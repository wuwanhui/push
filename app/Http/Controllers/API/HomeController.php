<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return "接口主页";

    }

}
