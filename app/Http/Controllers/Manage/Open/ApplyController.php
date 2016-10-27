<?php

namespace App\Http\Controllers\Manage\Open;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use App\Models\Distribution;
use App\Models\Open_Apply;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 应用中心
 * @package App\Http\Controllers\
 */
class ApplyController extends Controller
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

        $lists = Open_Apply::where(function ($query) use ($key, $userId) {
            if ($userId) {
                $query->where('userId', $userId);
            }
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('manage.open.apply.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $apply = new Open_Apply();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $apply->Rules(), $apply->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/open/apply/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $apply->fill($input);
                $apply->save();
                if ($apply) {
                    return redirect('/manage/open/apply')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }
            $users = User::all();
            return view('manage.open.apply.create', compact('apply', 'users'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
