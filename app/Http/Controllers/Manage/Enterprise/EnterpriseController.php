<?php

namespace App\Http\Controllers\Manage\Enterprise;

use App\Http\Controllers\Common\RespJson;
use App\Http\Controllers\Manage\BaseController;
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
class EnterpriseController extends BaseController
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
        $respJson = new RespJson();
        try {
            $key = $request->key;
            $list = Enterprise::where(function ($query) use ($key) {
                if ($key) {
                    $query->orWhere('name', 'like', '%' . $key . '%');//名称
                }
            })->withCount('members')->orderBy('id', 'desc')->paginate($this->pageSize);

            if (isset($request->json)) {
                $respJson->setData($list);
                return response()->json($respJson);
            }
            return view('manage.enterprise.index', compact('list'));
        } catch (Exception $ex) {
            $respJson->setCode(-1);
            $respJson->setMsg('异常！' . $ex->getMessage());
            return response()->json($respJson);
        }
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
