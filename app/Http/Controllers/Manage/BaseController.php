<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Http\Facades\Base;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BaseController extends Controller
{ 
    public $uid;
    public $eid;

    public function __construct()
    {
        dd(Auth::user());
        if (!Auth::check()) {
            return Redirect::guest('login');
        }


        if (Auth::check()) {
            if (Auth::user()->type != 0) {
                return Redirect::back()->withErrors('对不起无权访问！');
            }
        }


        if (Auth::user()->type != 0) {
            return Redirect::back()->withErrors('对不起无权访问！');
        }
        $this->uid = Base::uid();
        $this->eid = Base::user("enterpriseId");
    }

}
