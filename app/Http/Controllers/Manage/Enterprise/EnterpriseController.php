<?php

namespace App\Http\Controllers\Manage\Enterprise;

use App\Http\Controllers\Manage\ManageBaseController;
use App\Models\Distribution;
use App\Models\Enterprise;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 企业管理
 * @package App\Http\Controllers\
 */
class EnterpriseController extends ManageBaseController
{
    public function __construct()
    {

        if (!Auth::check()) {
            return Redirect::guest('login');
        }


        if (Auth::check()) {
            if (Auth::user()->type != 1) {
                return Redirect::back()->withErrors('对不起无权访问！');
            }
        }


        if (Auth::user()->type != 0) {
            return Redirect::back()->withErrors('对不起无权访问！');
        }
        $this->uid = Base::uid();
        $this->eid = Base::user("enterpriseId");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $lists = Enterprise::where(function ($query) use ($key) {
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('manage.enterprise.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $enterprise = new Enterprise();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $enterprise->Rules(), $enterprise->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/enterprise/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $enterprise->fill($input);
                $enterprise->save();
                if ($enterprise) {
                    return redirect('/manage/enterprise')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }


            return view('manage.enterprise.create', compact('enterprise'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
