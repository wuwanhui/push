<?php

namespace App\Http\Controllers\Weixin;

use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('weixin.member.index');
    }
}
