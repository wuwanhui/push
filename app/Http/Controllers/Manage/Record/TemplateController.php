<?php

namespace App\Http\Controllers\Manage\Record;

use App\Http\Controllers\Common\RespJson;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Manage\BaseController;
use App\Http\Controllers\Manage\ManageBaseController;
use App\Http\Facades\Base;
use App\Http\Facades\Sms;
use App\Models\Record_Template;
use App\Models\Supplier_Resource_Signature;
use App\Models\Supplier_Resource_Template;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 发送模板
 * @package App\Http\Controllers\Manage\Template
 */
class TemplateController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        view()->share(['_model' => 'manage/record']);
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $lists = Record_Template::where(function ($query) use ($key) {
 
            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);


        return view('manage.record.template.index', compact('lists'));
    }


    public function create(Request $request)
    {
        $respJson = new RespJson();
        try {

            $template = new Record_Template();
            if ($request->isMethod('POST')) {
                $input = $request->all();

                $validator = Validator::make($input, $template->Rules(), $template->messages());
                if ($validator->fails()) {
                    $respJson->code = 1;
                    $respJson->msg = '效验失败！' . $validator;
                    return json_encode($respJson);
                }
                $template->fill($input);
                $template->userId = Base::uid();
                $template->save();
                if ($template) {
                    $respJson->code = 0;
                    $respJson->msg = '保存成功';
                }
                return json_encode($respJson);
            }

        } catch (Exception $ex) {
            $respJson->code = -1;
            $respJson->msg = '异常！' . $ex->getMessage();
            Log::info('异常！' . $ex->getMessage());
        }
        return json_encode($respJson);
    }

    public function delete(Request $request, $id)
    {
        try {
            $template = Record_Template::find($id);
            $template->delete();
            return Redirect::back()->withSuccess('删除成功！');

        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }
}
