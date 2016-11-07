<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Http\Facades\Base;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ManageBaseController extends Controller
{
    public $uid;
    public $eid;

    public function __construct()
    {

    }

}
