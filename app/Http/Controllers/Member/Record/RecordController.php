<?php

namespace App\Http\Controllers\Member\Record;

use App\Http\Controllers\Common\RespJson;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Member\BaseController;
use App\Http\Facades\Base;
use App\Http\Facades\Sms;
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
        $key = $request->key;
        $lists = Record::where(function ($query) use ($key) {

            if (Base::member("type") == 0) {
                $query->whereIn('memberId', Base::member()->enterprise->members->pluck("id"));
            } else {
                $query->Where('memberId', Base::member("id"));
            }
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
                $record->save();

                return json_encode($this->send($record->id));
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
            $newRecord->save();

            $respJson = $this->send($newRecord->id);
            if ($respJson->code == 0) {
                return redirect('/member/record')->withSuccess('重发成功！');
            }
            return redirect('/member/record')->withErrors('重发失败！' . $respJson->msg);
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


                    if (isset($resp->result)) {
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

//        Log::info(json_encode($respJson));
//        return;
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
