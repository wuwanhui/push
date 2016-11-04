<?php

namespace App\Http\Controllers\Member\Enterprise;

use App\Http\Controllers\Member\BaseController;
use App\Http\Facades\Base;
use App\Models\Enterprise;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 企业管理
 * @package App\Http\Controllers\
 */
class EnterpriseController extends BaseController
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $enterprise = Enterprise::find(Base::user("enterpriseId"));

            if (Base::user("type") == 2) {
                if ($request->isMethod('POST')) {
                    $input = $request->all();
                    $validator = Validator::make($input, $enterprise->Rules(), $enterprise->messages());
                    if ($validator->fails()) {
                        echo "效验失败";
                        return redirect('/member/enterprise/create')
                            ->withInput()
                            ->withErrors($validator);
                    }

                    $enterprise->fill($input);
                    $enterprise->save();
                    if ($enterprise) {
                        return redirect('/member/enterprise')->withSuccess('保存成功！');
                    }
                    return Redirect::back()->withErrors('保存失败！');
                }

                return view('member.enterprise.edit', compact('enterprise'));
            }
            return view('member.enterprise.detail', compact('enterprise'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function create(Request $request)
    {
        try {
            $enterprise = new Enterprise();
            $this->authorize('create', $enterprise);//权限检查

            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $enterprise->Rules(), $enterprise->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/member/enterprise/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $enterprise->fill($input);
                $enterprise->save();
                if ($enterprise) {
                    return redirect('/member/enterprise')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }


            return view('member.enterprise.create', compact('enterprise'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function edit(Request $request)
    {
        try {
            $enterprise = Enterprise::find(Base::user("enterpriseId"));
            $this->authorize('update', $enterprise);//权限检查


            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $enterprise->Rules(), $enterprise->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/member/enterprise/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $enterprise->fill($input);
                $enterprise->save();
                if ($enterprise) {
                    return redirect('/member/enterprise')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }


            return view('member.enterprise.create', compact('enterprise'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }
}
