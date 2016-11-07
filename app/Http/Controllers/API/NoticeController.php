<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Member\BaseController;
use App\Http\Facades\Base;
use App\Models\Distribution;
use App\Models\Directorie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Qiniu\Auth;

/**
 * 通知
 * @package App\Http\Controllers\
 */
class NoticeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * 微信通知
     *
     * @return \Illuminate\Http\Response
     */
    public function wxpay(Request $request)
    {

        dd($request->all());

        return
            $json = json_encode($xml, JSON_UNESCAPED_UNICODE);
        print_r($json);


        $key = $request->key;

        $lists = Directorie::where(function ($query) use ($key) {
            if (Base::member("type") == 0) {
                $query->whereIn('memberId', Base::member()->enterprise->members->pluck("id"));
            } else {
                $query->Where('memberId', Base::member("id"));
            }
            $query->orWhere('share', '1');//公有
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('member.directorie.index', compact('lists'));
    }

}
