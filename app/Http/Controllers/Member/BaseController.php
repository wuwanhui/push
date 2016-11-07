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
        view()->share(['_model' => 'member']);
    }


}
