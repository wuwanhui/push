<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Facades\Base;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BaseController extends Controller
{
    public $uid;
    public $eid;

    public function __construct()
    {
        if (!Auth::check()) {
            return Redirect::guest('login');
        }
        if (Auth::user()->type != 1) {
            return Redirect::back()->withErrors('对不起无权访问！');
        }
        $this->uid = Base::uid();
        $this->eid = Base::user("enterpriseId");
    }

}
