<?php

namespace App\Http\Controllers\Member\Enterprise;

use App\Http\Controllers\Member\BaseController;
use App\Http\Facades\Base;
use App\Models\Member;
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
    public function __construct()
    {
        parent::__construct();
        view()->share(['_model' => 'member/enterprise']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $enterpriseId = Base::member('enterpriseId');
        $lists = Member::where(function ($query) use ($key, $enterpriseId) {
            if ($enterpriseId) {
                $query->where('enterpriseId', $enterpriseId);
            }
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('member.enterprise.user.index', compact('lists'));
    }

    public function create(Request $request)
    {
        try {
            $merber = new Member();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $merber->Rules(), $merber->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/member/enterprise/user/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $merber->fill($input);
                $merber->password = bcrypt($request->input('password'));
                $merber->enterpriseId = Base::member("enterpriseId");
                $merber->save();
                if ($merber) {
                    return redirect('/member/enterprise/user')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }
            return view('member.enterprise.user.create', compact('user'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function edit($id, Request $request)
    {
        try {
            $merber = Member::find($id);
            if (!$merber) {
                return Redirect::back()->withErrors('数据不存在！');
            }
            if ($merber->enterpriseId != Base::member("enterpriseId") || Base::member("type") != 2) {
                return Redirect::back()->withErrors('无权修改！');
            }
            if ($request->isMethod('POST')) {

                $oldPassword = $merber->password;
                $input = $request->all();
                $validator = Validator::make($input, $merber->Rules(), $merber->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/member/enterprise/user/edit/' . $id)
                        ->withInput()
                        ->withErrors($validator);
                }


                $merber->fill($input);
                if ($request->input('password')) {
                    $merber->password = bcrypt($request->input('password'));
                } else {
                    $merber->password = $oldPassword;
                }

                $merber->save();
                if ($merber) {
                    return redirect('/member/enterprise/user')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            return view('member.enterprise.user.edit', compact('user'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function delete($id, Request $request)
    {
        try {
            $merber = Member::find($id);
            if (!$merber) {
                return Redirect::back()->withErrors('数据不存在！');
            }
            $merber->delete();
            return redirect('/member/enterprise/user')->withSuccess('删除成功！');

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }
}
