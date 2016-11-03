<?php

namespace App\Http\Controllers\Manage\Directorie;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Manage\BaseController;
use App\Models\Distribution;
use App\Models\Directorie;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 通讯录管理
 * @package App\Http\Controllers\
 */
class DirectorieController extends BaseController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;

        $lists = Directorie::where(function ($query) use ($key) {
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('manage.directorie.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $directorie = new Directorie();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $directorie->Rules(), $directorie->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/directorie/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $directorie->fill($input);
                $directorie->save();
                if ($directorie) {
                    return redirect('/manage/directorie')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }


            return view('manage.directorie.create', compact('directorie'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
