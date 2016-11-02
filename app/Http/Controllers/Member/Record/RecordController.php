<?php

namespace App\Http\Controllers\Member\Record;

use App\Http\Controllers\Common\RespJson;
use App\Http\Controllers\Controller;
use App\Http\Facades\Base;
use App\Http\Facades\Sms;
use App\Models\Record;
use App\Models\Record_Template;
use App\Models\Supplier_Resource_Signature;
use App\Models\Supplier_Resource_Template;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

/**
 * 发送记录
 * @package App\Http\Controllers\Member\Record
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


        return view('member.record.index', compact('lists'));
    }


    public function create(Request $request)
    {

        try {
            $record = new Record();
            if ($request->isMethod('POST')) {
                $input = $request->all();

                $validator = Validator::make($input, $record->Rules(), $record->messages());
                if ($validator->fails()) {
                    return "效验失败";
                }
                $record->fill($input);
                $record->userId = Base::uid();
                $record->save();

                return $this->send($record->id);
            }
            $templateList = Record_Template::where("userId", Base::uid())->orWhere("share", 1)->get();

            $signatures = Supplier_Resource_Signature::where("enterpriseId", Base::user("enterpriseId"))->orWhere("enterpriseId", 0)->get();
            $templates = Supplier_Resource_Template::where("enterpriseId", Base::user("enterpriseId"))->orWhere("enterpriseId", 0)->get();
            return view('member.record.create', compact('record', 'signatures', 'templates', 'templateList'));
        } catch (Exception $ex) {
            return '异常！' . $ex->getMessage();
        }
    }

    public function createByid(Request $request, $id)
    {
        try {
            $template = Record_Template::find($id);
            if (!$template) {
                return redirect('/member/record/create')->withSuccess('模板不存在！');
            }

            $templateList = Record_Template::where("userId", Base::uid())->orWhere("share", 1)->get();

            return view('member.record.template', compact('template', 'templateList'));
        } catch (Exception $ex) {
            return '异常！' . $ex->getMessage();
        }
    }

    /**
     * 短信发送
     * @param $id
     */
    protected function send($id)
    {
        $respJson = new RespJson();
        try {
            $record = Record::find($id);
            if ($record) {
                if ($record->state == 1) {
                    $signature = Supplier_Resource_Signature::find($record->signatureId);
                    $template = Supplier_Resource_Template::find($record->templateId);

                    $mobiles = $record->mobile;
                    $param = $record->param;
                    $templateCode = $template->number;
                    $sign = $signature->name;
                    //计费计算

                    $record->charging = count(explode(",", $mobiles)) * ceil(mb_strlen($record->content . "【" . $signature->name . "】", 'utf8') / $template->resource->words);


                    $resp = Sms::send($mobiles, $param, $templateCode, $sign);
                    $record->sendLog = json_encode($resp);


                    if ($resp->result) {
                        $respJson->code = 0;
                        $respJson->msg = "提交成功";
                    } else {
                        $record->state = 2;
                        $respJson->code = 1;
                        $respJson->msg = "提交失败:" . $resp->sub_msg;
                        Log::info('短信发送失败： ' . json_encode($resp));
                    }
                    $record->save();
                }

            }
        } catch (Exception $ex) {
            $respJson->code = -1;
            $respJson->msg = '异常！' . $ex->getMessage();
            Log::info('异常！' . $ex->getMessage());
        }

//        v(json_encode($respJson));
//        return;
        return json_encode($respJson);

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
