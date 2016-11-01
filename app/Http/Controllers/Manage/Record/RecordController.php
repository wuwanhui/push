<?php

namespace App\Http\Controllers\Manage\Record;

use App\Http\Controllers\Common\RespJson;
use App\Http\Controllers\Controller;
use App\Http\Facades\Base;
use App\Http\Facades\Sms;
use App\Models\Record;
use App\Models\Supplier_Resource_Signature;
use App\Models\Supplier_Resource_Template;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        $respJson = new RespJson();
        try {
            $record = new Record();
            if ($request->isMethod('POST')) {
                $input = $request->all();


                $validator = Validator::make($input, $record->Rules(), $record->messages());
                if ($validator->fails()) {
                    return "效验失败";
                }
                $template = Supplier_Resource_Template::find($request->input("templateId"));
                $signature = Supplier_Resource_Signature::find($request->input("signatureId"));
                Log::info("signature：" . json_encode($signature));

                $mobiles = $request->input("mobile");;
                $param = $request->input("param");
                $content = $request->input("content");
                $sendTime = $request->input("sendTime");
                $charging = ceil(mb_strlen($record->content . "【" . $signature->name . "】", 'utf8') / $template->resource->words);
                $resp = Sms::send($mobiles, $param, $template->number, $signature->number);


                $sendLog = json_encode($resp);
                $sendList[] = array();
                $list = explode(",", $mobiles);
                foreach ($list as $item => $value) {
                    $record = new Record();
                    $record->signatureId = $signature->id;
                    $record->templateId = $template->id;
                    $record->mobile = $value;
                    $record->content = $content;
                    $record->param = $param;
                    if ($sendTime) {
                        $record->sendTime = $sendTime;
                    }
                    $record->charging = $charging;
                    $record->sendLog = $sendLog;
                    if (isset($resp->result)) {
                        $record->bizId = $resp->result->model;
                        $respJson->code = 0;
                        $respJson->msg = "提交成功";
                    } else {
                        $record->state = 2;
                        $respJson->code = 1;
                        $respJson->msg = "提交失败:" . $resp->sub_msg;
                        Log::info('短信发送失败： ' . json_encode($resp));
                    }
                    $record->userId = Base::uid();
                    $record->save();
                    array_push($sendList, $record);

                }

//                $record->fill($sendList)->save();
//                //$record->insert($sendList);

                return json_encode($respJson);
            }

            $signatures = Supplier_Resource_Signature::where("enterpriseId", Base::user("enterpriseId"))->orWhere("enterpriseId", 0)->get();
            $templates = Supplier_Resource_Template::where("enterpriseId", Base::user("enterpriseId"))->orWhere("enterpriseId", 0)->get();
            return view('manage.record.create', compact('record', 'signatures', 'templates'));
        } catch (Exception $ex) {
            $respJson->code = -1;
            $respJson->msg = "异常：" . $ex->getMessage();
            return json_encode($respJson);

        }
    }

    public function detail($id, Request $request)
    {
        try {
            $record = Record::find($id);
            if (!$record) {
                return Redirect::back()->withErrors('数据不存在！');
            }

            return view('manage.record.detail', compact('record'));
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
                    Log::info("发送短信日志：" . json_encode($resp));
                    $record->sendLog = json_encode($resp);


                    if ($resp->result) {
                        $respJson->code = 0;
                        $respJson->msg = "提交成功";
                        $record->bizId = $resp->result->model;
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
