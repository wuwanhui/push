<?php

namespace App\Http\Controllers\Manage\Record;

use App\Http\Controllers\Controller;
use App\Http\Facades\Base;
use App\Http\Facades\Sms;
use App\Models\Record;
use App\Models\Supplier_Resource_Signature;
use App\Models\Supplier_Resource_Template;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 发送记录
 * @package App\Http\Controllers\Manage\Record
 */
class RecordController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $key = $request->key;
        $lists = Record::where(function ($query) use ($key) {

            $query->Where('userId', Base::uid());

            if ($key) {
                $query->orWhere('name', 'like', '%' . $key . '%');//名称
            }
        })->orderBy('id', 'desc')->paginate($this->pageSize);


        return view('manage.record.index', compact('lists'));
    }


    public function create(Request $request)
    {

        try {
            $record = new Record();
            if ($request->isMethod('POST')) {
                $input = $request->all();

                $validator = Validator::make($input, $record->Rules(), $record->messages());
                if ($validator->fails()) {
                    return redirect('/manage/record/create')
                        ->withInput()
                        ->withErrors($validator);
                }
                $record->fill($input);
                $record->userId = Base::uid();
                $record->save();
                $this->send($record->id);
                if ($record) {
                    return redirect('/manage/record')->withSuccess('保存成功！');
                }
                return Redirect::back()->withErrors('保存失败！');
            }

            $signatures = Supplier_Resource_Signature::all();
            $templates = Supplier_Resource_Template::all();
            return view('manage.record.create', compact('record', 'signatures', 'templates'));
        } catch (Exception $ex) {
            return Redirect::back()->withInput()->withErrors('异常！' . $ex->getMessage());
        }
    }

    /**
     * 短信发送
     * @param $id
     */
    protected function send($id)
    {
        $record = Record::find($id);
        if ($record) {
            if ($record->state == 1) {
                $signature = Supplier_Resource_Signature::find($record->signatureId);
                $template = Supplier_Resource_Template::find($record->templateId);

                $mobiles = $record->mobile;
                $param = $record->param;
                $templateCode = $template->number;
                $sign = $signature->name;

                $log = Sms::send($mobiles, $param, $templateCode, $sign);
                if ($log) {
                    $record->remark = $log;
                    $record->save();
                }
            }

        }


    }


    /**
     * 获取模板
     * @param Request $request
     * @return string
     */
    public function template(Request $request)
    {
        $templateId = $request->id;
        $template = Supplier_Resource_Template::find($templateId);
        return json_encode($template);
    }


}
