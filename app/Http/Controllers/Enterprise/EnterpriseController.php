<?php

namespace App\Http\Controllers\Enterprise;

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

    public function __construct()
    {
        parent::__construct();
        view()->share(['_model' => 'enterprise/enterprise']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {

            if (Base::enterprise("type") == 0) {
                return redirect('/enterprise/enterprise/edit');
            }
            return redirect('/enterprise/enterprise/detail');

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
                    return redirect('/enterprise/enterprise/create')
                        ->withInput()
                        ->withErrors($validator);
                }

                $enterprise->fill($input);
                $enterprise->save();
                if ($enterprise) {
                    return redirect('/enterprise/enterprise')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }


            return view('enterprise.enterprise.create', compact('enterprise'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function edit(Request $request)
    {
        try {
            $enterprise = Base::enterprise()->enterprise;
            //$this->authorize('update', $enterprise);//权限检查


            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $enterprise->Rules(), $enterprise->messages());
                if ($validator->fails()) {
                    echo "效验失败";
                    return redirect('/enterprise/enterprise/edit')
                        ->withInput()
                        ->withErrors($validator);
                }

                $enterprise->fill($input);
                $enterprise->save();
                if ($enterprise) {
                    return redirect('/enterprise/enterprise')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }


            return view('enterprise.enterprise.edit', compact('enterprise'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    public function detail(Request $request)
    {
        try {
            $enterprise = $enterprise = Base::enterprise()->enterprise;
            return view('enterprise.enterprise.detail', compact('enterprise'));

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }
}
