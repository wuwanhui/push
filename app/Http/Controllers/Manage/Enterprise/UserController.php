<?php

namespace App\Http\Controllers\Manage\Enterprise;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Manage\BaseController;
use App\Models\Enterprise;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 用户管理
 * @package App\Http\Controllers\
 */
class UserController extends BaseController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $enterpriseId = $request->enterpriseId;


        $lists = User::where(function ($query) use ($key, $enterpriseId) {
            if ($enterpriseId) {
                $query->where('enterpriseId', $enterpriseId);
            }
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('manage.enterprise.user.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $user = new User();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $user->Rules(), $user->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/enterprise/user/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $user->fill($input);
                $user->password = bcrypt($request->input('password'));
                $user->save();
                if ($user) {
                    return redirect('/manage/enterprise/user')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }
            $enterprises = Enterprise::all();
            return view('manage.enterprise.user.create', compact('user', 'enterprises'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function edit($id, Request $request)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return Redirect::back()->withErrors('数据不存在！');
            }

            if ($request->isMethod('POST')) {

                $oldPassword = $user->password;
                $input = $request->all();
                $validator = Validator::make($input, $user->editRules(), $user->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/enterprise/user/edit/' . $id)
                        ->withInput()
                        ->withErrors($validator);
                }


                $user->fill($input);
                if ($request->input('password')) {
                    $user->password = bcrypt($request->input('password'));
                } else {
                    $user->password = $oldPassword;
                }

                $user->save();
                if ($user) {
                    return redirect('/manage/enterprise/user')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            $enterprises = Enterprise::all();
            return view('manage.enterprise.user.edit', compact('user', 'enterprises'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function delete($id, Request $request)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return Redirect::back()->withErrors('数据不存在！');
            }
            $user->delete();
            return redirect('/manage/enterprise/user')->withSuccess('删除成功！');

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
