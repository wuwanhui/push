<?php

namespace App\Http\Controllers\Member\Record;

use App\Http\Controllers\Common\RespJson;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Member\BaseController;
use App\Http\Facades\Base;
use App\Http\Facades\Sms;
use App\Http\SDK\TencentSmsSdk;
use App\Models\Record;
use App\Models\Record_Template;
use App\Models\Supplier_Resource_Signature;
use App\Models\Supplier_Resource_Template;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use stdClass;

/**
 * 发送记录
 * @package App\Http\Controllers\Member\Record
 */
class RecordController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        view()->share(['_model' => 'member/record']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $batchId = $request->batchId;
        $key = $request->key;
        $lists = Record::where(function ($query) use ($key, $batchId) {
            $query->Where('batchId', $batchId);
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
                $record->memberId = Base::member("id");
                $resp = $this->send($record);
                return json_encode($resp);
            }
            $record->mobile = $request->mobile;
            $templateList = Record_Template::where("memberId", Base::member("id"))->orWhere("share", 1)->get();

            $signatures = Supplier_Resource_Signature::where("enterpriseId", Base::member("enterpriseId"))->orWhere("enterpriseId", 0)->get();
            $templates = Supplier_Resource_Template::where("enterpriseId", Base::member("enterpriseId"))->orWhere("enterpriseId", 0)->get();
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

            $templateList = Record_Template::where("memberId", Base::member("id"))->orWhere("share", 1)->get();

            return view('member.record.template', compact('template', 'templateList'));
        } catch (Exception $ex) {
            return '异常！' . $ex->getMessage();
        }
    }


    public function retry(Request $request, $id)
    {
        try {
            $record = Record::find($id);
            if (!$record) {
                return Redirect::back()->withErrors('数据不存在！');
            }
            $newRecord = new Record();
            $newRecord->memberId = $record->memberId;
            $newRecord->signatureId = $record->signatureId;
            $newRecord->templateId = $record->templateId;
            $newRecord->mobile = $record->mobile;
            $newRecord->content = $record->content;
            $newRecord->param = $record->param;
            $newRecord->source = $record->source;
            $newRecord->remark = '重发记录' . $record->id;
            $respJson = $this->send($newRecord);

            if ($respJson->code == 0) {
                return redirect('/member/record')->withSuccess('重发成功！');
            }
            return redirect('/member/record')->withErrors('重发失败！' . $respJson->msg);
        } catch (Exception $ex) {
            return '异常！' . $ex->getMessage();
        }
    }


    public function detail(Request $request, $id)
    {
        try {
            $record = Record::find($id);
            if (!$record) {
                return Redirect::back()->withErrors('数据不存在！');
            }
            $sendData = date('Ymd', strtotime($record->created_at));
            $req = Sms::query($record->bizId, $record->mobile, $sendData, 1, 1);

            if (isset($req->error_response)) {
                return Redirect::back()->withErrors('获取数据错误！' . $req->error_response->sub_msg);
            }
            $record->

            dd($req);
            return;
            $newRecord->templateId = $record->templateId;
            $newRecord->mobile = $record->mobile;
            $newRecord->content = $record->content;
            $newRecord->param = $record->param;
            $newRecord->source = $record->source;
            $newRecord->remark = '重发记录' . $record->id;
            $newRecord->save();

            return view('member.record.detail', compact('$record'));
        } catch (Exception $ex) {
            return '异常！' . $ex->getMessage();
        }
    }


    /**
     * 短信发送
     * @param $id
     */
    protected function send($record)
    {
        $respJson = new RespJson();
        try {
            if ($record) {
                $signature = Supplier_Resource_Signature::find($record->signatureId);
                $template = Supplier_Resource_Template::find($record->templateId);
                $smsParam = new stdClass();
                $smsParam->mobiles = $record->mobile;
                $smsParam->param = $record->param;
                $smsParam->content = $record->content;
                $smsParam->templateId = $template->number;
                $smsParam->template = $template->content;
                $smsParam->signId = $signature->number;
                $smsParam->sign = $signature->name;
                //计费计算
                $charging = ceil(mb_strlen($record->content . "【" . $signature->name . "】", 'utf8') / $template->words);
                $record->charging = count(explode(",", $smsParam->mobiles)) * $charging;
                if ($record->charging > Base::member()->balanceMoney) {
                    $respJson->code = 3;
                    $respJson->msg = "余额不足！";
                    return $respJson;
                }


                $resp = $this->distribute($signature->resource, $smsParam);
                $record->sendLog = $resp->sendLog;
                if ($resp->code == 0) {
                    $record->bizId = $resp->bizId;
                    $respJson->code = 0;
                    $respJson->msg = $resp->msg;
                } else {
                    $record->state = 2;
                    $respJson->code = 1;
                    $respJson->msg = $resp->msg;
                    Log::info('短信发送失败： ' . json_encode($resp));
                }
                $record->save();

            }
        } catch (Exception $ex) {
            $respJson->code = -1;
            $respJson->msg = '异常！' . $ex->getMessage();
            Log::info('异常！' . $ex->getMessage());
        }

//        Log::info(json_encode($respJson));
//        return;
        return $respJson;

    }

    /**
     * 短信分发
     */
    protected function distribute($resource, $smsParam)
    {

        $resp = new stdClass();
        switch ($resource->supplier->id) {
            case 1:
                $resq = Sms::send($smsParam->mobiles, $smsParam->param, $smsParam->templateId, $smsParam->sign);
                $resp->sendLog = json_encode($resq);
                if (isset($resq->result) && $resq->result->success) {
                    $resp->bizId = $resq->result->model;
                    $resp->code = 0;
                    $resp->msg = "提交成功";
                } else {
                    $resp->code = 1;
                    $resp->msg = "提交失败" . $resq->sub_msg;
                }
                break;
            case 2:
                $sms = new TencentSmsSdk($resource->appKey, $resource->secretKey);

                $mobiles = explode(",", $smsParam->mobiles);
                $content = "【" . $smsParam->sign . "】" . $smsParam->content;

                if (count($mobiles) > 1) {
                    $resq = $sms->multipleSms($mobiles, $content);
                } else {
                    $resq = $sms->sendSms($smsParam->mobiles, $content);
                }
                $resp->sendLog = $resq;
                $resqJson = json_decode($resq);

                if (isset($resqJson->result) && $resqJson->result == 0) {
                    $resp->bizId = $resq->result->model;
                    $resp->code = 0;
                    $resp->msg = "提交成功";
                } else {
                    $resp->code = 1;
                    $resp->msg = "提交失败" . $resq->sub_msg;
                }
                break;
            default:
                $resq = Sms::send($smsParam->mobiles, $smsParam->param, $smsParam->templateId, $smsParam->sign);
                $resp->sendLog = json_encode($resq);
                if (isset($resq->result) && $resq->result->success) {
                    $resp->bizId = $resq->result->model;
                    $resp->code = 0;
                    $resp->msg = "提交成功";
                } else {
                    $resp->code = 1;
                    $resp->msg = "提交失败" . $resq->sub_msg;
                }
                break;
        }
        return $resp;
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
