<?php

namespace App\Http\Controllers\Member\Record;

use App\Http\Controllers\Common\RespJson;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Member\BaseController;
use App\Http\Facades\Base;
use App\Http\Facades\Sms;
use App\Http\SDK\TencentSmsSdk;
use App\Models\Record;
use App\Models\Record_Batch;
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
class BatchController extends BaseController
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
        $key = $request->key;
        $lists = Record_Batch::
        leftJoin('Member', 'Record_Batch.memberId', '=', 'Member.id')
            ->leftJoin('Supplier_Resource_Template', 'Record_Batch.templateId', '=', 'Supplier_Resource_Template.id')
            ->leftJoin('Supplier_Resource_Signature', 'Record_Batch.signatureId', '=', 'Supplier_Resource_Signature.id')
            ->select('Record_Batch.*', 'Member.name as memberName', 'Supplier_Resource_Template.name as templateName', 'Supplier_Resource_Signature.name as signatureName')
            ->where(function ($query) use ($key) {

                if (Base::member("type") == 0) {
                    $query->whereIn('memberId', Base::member()->enterprise->members->pluck("id"));
                } else {
                    $query->Where('memberId', Base::member("id"));
                }
                if ($key) {
                    $query->orWhere('name', 'like', '%' . $key . '%');//名称
                }
            })->orderBy('id', 'desc')->paginate($this->pageSize);


        return view('member.record.batch.index', compact('lists'));
    }


    public function create(Request $request)
    {
        try {
            $batch = new Record_Batch();

            $respJson = new RespJson();
            if ($request->isMethod('POST')) {
                $input = $request->all();
                $validator = Validator::make($input, $batch->Rules(), $batch->messages());
                if ($validator->fails()) {
                    return "效验失败";
                }
                $batch->fill($input);
                $batch->memberId = Base::member("id");
                $batch->save();

                $resp = $this->send($batch);

                if ($resp->code == 0) {
                    $respJson->code = "0";
                    $respJson->msg = "发送成功";
                } else {
                    $respJson->code = "0";
                    $respJson->msg = "发送失败";
                }
                return response('Hello World');
//                $json = json_encode($respJson,true);
//                Log::info(isjson(json_encode($resp)));
                return json_encode($respJson, true);
            }
            $templateList = Record_Template::where("memberId", Base::member("id"))->orWhere("share", 1)->get();
            $signatures = Supplier_Resource_Signature::where("enterpriseId", Base::member("enterpriseId"))->orWhere("enterpriseId", 0)->get();
            $templates = Supplier_Resource_Template::where("enterpriseId", Base::member("enterpriseId"))->orWhere("enterpriseId", 0)->get();
            return view('member.record.batch.create', compact('record', 'signatures', 'templates', 'templateList'));
        } catch (Exception $ex) {
            return '异常！' . $ex->getMessage() . $ex->getLine();
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

            return view('member.record.batch.template', compact('template', 'templateList'));
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
                return redirect('/member/record/batch')->withSuccess('重发成功！');
            }
            return redirect('/member/record/batch')->withErrors('重发失败！' . $respJson->msg);
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
    protected function send(Record_Batch $batch)
    {
        $respJson = new RespJson();
        try {
            if ($batch) {
                $signature = Supplier_Resource_Signature::find($batch->signatureId);
                $template = Supplier_Resource_Template::find($batch->templateId);

                //计费计算
                $price = ceil(mb_strlen($batch->content . "【" . $signature->name . "】", 'utf8') / $template->words);//单价
                $total = count(explode(",", $batch->mobiles)) * $price;//合计金额

                if ($total > Base::member()->balanceMoney) {
                    $batch->state = 4;
                    $batch->save();
                    $respJson->code = 1;
                    $respJson->msg = "余额不足";
                    return $respJson;
                }

                $smsParam = new stdClass();
                $smsParam->mobiles = $batch->mobile;
                $smsParam->param = $batch->param;
                $smsParam->content = $batch->content;
                $smsParam->templateId = $template->number;
                $smsParam->template = $template->content;
                $smsParam->signId = $signature->number;
                $smsParam->sign = $signature->name;
                $resp = $this->distribute($batch, $smsParam);
                if ($resp->code == 0) {
                    $respJson->code = 0;
                    $respJson->msg = $resp->msg;
                } else {
                    $respJson->code = 1;
                    $respJson->msg = $resp->msg;
                    //Log::info('短信发送失败： ' . json_encode($resp));
                }

            }
        } catch (Exception $ex) {
            $respJson->code = -1;
            $respJson->msg = '异常！' . $ex->getMessage();
            Log::info('异常！' . $ex->getMessage() . '行号：' . $ex->getLine());
        }
        //Log::info(json_encode($respJson));
        return $respJson;

    }

    /**
     * 短信分发
     */
    protected function distribute($batch, $smsParam)
    {

        $respJson = new RespJson();
        try {
            $resource = $batch->signature->resource;
            switch ($resource->supplier->id) {
                case 1:
                    $resq = Sms::send($smsParam->mobiles, $smsParam->param, $smsParam->templateId, $smsParam->sign);

                    if (isset($resq->result) && $resq->result->success) {
                        $respJson->code = 0;
                        $respJson->msg = "提交成功";
                    } else {
                        $respJson->code = 1;
                        $respJson->msg = "提交失败" . $resq->sub_msg;
                    }
                    break;
                case 2:
                    //腾讯短信
                    $sms = new TencentSmsSdk($resource->appKey, $resource->secretKey);

                    $mobiles = explode(",", $smsParam->mobiles);
                    $content = "【" . $smsParam->sign . "】" . $smsParam->content;
                    $price = ceil(mb_strlen($content, 'utf8') / $batch->template->words);//单价

                    if (count($mobiles) > 0) {
                        $resq = $sms->multipleSms($mobiles, $content);
                    } else {
                        $resq = $sms->sendSms($smsParam->mobiles, $content);
                    }
                    if (isset($resq->result) && $resq->result == 0) {
                        $batch->state = 1;
                        $respJson->code = 0;
                        $respJson->msg = "提交成功";
                    } else {
                        $errmsg = "提交失败";
                        if (isset($resq->errmsg)) {
                            $errmsg = $resq->errmsg;
                        }
                        $batch->state = 2;
                        $batch->remark = $errmsg;
                        $respJson->code = 1;
                        $respJson->msg = $errmsg;

                    }

                    foreach ($mobiles as $item) {
                        $record = new Record();
                        $record->batchId = $batch->id;
                        $record->mobile = $item;
                        $record->content = $content;
                        $record->param = $smsParam->param;
                        $record->charging = $price;

                        if (isset($resq->result) && $resq->result == 0) {
                            foreach ($resq->detail as $smsItem) {
                                if ($smsItem->mobile == $item) {
                                    if ($smsItem->result == 0) {
                                        $record->state = 1;
                                        $record->sid = $smsItem->sid;
                                    } else {
                                        $record->state = 2;
                                        $record->remark = $smsItem->errmsg;
                                    }
                                }
                            }
                        }
                        $record->save();
                    }
                    break;

            }
        } catch (Exception $ex) {
            $respJson->code = -1;
            $respJson->msg = '异常！' . $ex->getMessage();
            Log::info('异常！' . $ex->getMessage() . $ex->getLine());
        }

        return $respJson;
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
