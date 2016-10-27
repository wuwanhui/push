<?php

namespace App\Http\Controllers\Manage\Open;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use App\Models\Distribution;
use App\Models\Open_Api;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 接口中心
 * @package App\Http\Controllers\
 */
class ApiController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $userId = $request->input('userId');

        $lists = Open_Api::where(function ($query) use ($key, $userId) {
            if ($userId) {
                $query->where('userId', $userId);
            }
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('manage.open.api.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $api = new Open_Api();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $api->Rules(), $api->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/open/api/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $api->fill($input);
                $api->save();
                if ($api) {
                    return redirect('/manage/open/api')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }
            $users = User::all();
            return view('manage.open.api.create', compact('api', 'users'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
