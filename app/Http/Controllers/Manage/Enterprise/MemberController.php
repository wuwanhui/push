<?php

namespace App\Http\Controllers\Manage\Enterprise;

use App\Http\Controllers\Manage\BaseController;
use App\Models\Enterprise;
use App\Models\Member_User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 用户管理
 * @package App\Http\Controllers\
 */
class MemberController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        view()->share(['_model' => 'manage/enterprise']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $eid = $request->eid;
        $list = Member_User::where(function ($query) use ($key, $eid) {
            if ($eid) {
                $query->where('eid', $eid);
            }
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');
            }
        })->with(['enterprise' => function ($query) {
            $query->select('id', 'name');
        }])->orderBy('id', 'desc')->paginate($this->pageSize);

        return view('manage.enterprise.member.index', compact('list'));
    }

    public function getCreate(Request $request)
    {
        try {
            $member = new Member_User();
            return view('manage.enterprise.member.create', compact('member'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function create(Request $request)
    {
        try {
            $member = new Member_User();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $member->Rules(), $member->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/enterprise/member/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $member->fill($input);
                $member->password = bcrypt($request->input('password'));
                $member->save();
                if ($member) {
                    return redirect('/manage/enterprise/member')->withSuccess('保存成功！');
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
            $member = Member_User::find($id);
            if (!$member) {
                return Redirect::back()->withErrors('数据不存在！');
            }

            if ($request->isMethod('POST')) {

                $oldPassword = $member->password;
                $input = $request->all();
                $validator = Validator::make($input, $member->editRules(), $member->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/manage/enterprise/member/edit/' . $id)
                        ->withInput()
                        ->withErrors($validator);
                }


                $member->fill($input);
                if ($request->input('password')) {
                    $member->password = bcrypt($request->input('password'));
                } else {
                    $member->password = $oldPassword;
                }

                $member->save();
                if ($member) {
                    return redirect('/manage/enterprise/member')->withSuccess('保存成功！');
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
            $member = Member_User::find($id);
            if (!$member) {
                return Redirect::back()->withErrors('数据不存在！');
            }
            $member->delete();
            return redirect('/manage/enterprise/member')->withSuccess('删除成功！');

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

}
