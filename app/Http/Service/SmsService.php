<?php

namespace App\Http\Service;

use AlibabaAliqinFcSmsNumQueryRequest;
use AlibabaAliqinFcSmsNumSendRequest;
use App\Models\Receive;
use App\Models\Record_Receive;
use Illuminate\Support\Facades\Log;
use TmcMessagesConfirmRequest;
use TmcMessagesConsumeRequest;
use TopClient;

/**
 * 短信服务
 * @package App\Http\Service
 */
class SmsService
{
    private $appkey = "23475448";
    private $secretKey = "b913a8a47a1734e625eb9149f7a2dd4d";
    private $client = null;

    public function __construct()
    {
        $this->client = new TopClient();
        $this->client->format = "json";
        //请填写自己的app key
        $this->client->appkey = $this->appkey;
        //请填写自己的app secret
        $this->client->secretKey = $this->secretKey;
    }


    /**
     * 发送短信
     * @param $mobiles
     * @param $param
     * @param $templateCode
     * @param $sign
     * @param string $type
     * @return mixed|\ResultSet|\SimpleXMLElement
     */
    public function send($mobiles, $param, $templateCode, $sign, $type = "normal")
    {
        $req = new AlibabaAliqinFcSmsNumSendRequest;
        $req->setSmsType($type);
        $req->setSmsFreeSignName($sign);
        $req->setSmsParam($param);
        $req->setRecNum($mobiles);
        //短信模板id
        $req->setSmsTemplateCode($templateCode);
        // $req->setExtend($extend);
        $resp = $this->client->execute($req);

        return $resp;
    }


    /**
     * 短信发送记录查询
     * @param $bizId短信发送流水
     * @param $recNum短信接收号码
     * @param $queryDate短信发送日期 ，支持近30天记录查询，格式yyyyMMdd
     * @param $currentPage分页参数 ,页码
     * @param $pageSize分页参数 ，每页数量。最大值50
     * @return mixed|\ResultSet|\SimpleXMLElement
     */
    public function query($bizId, $recNum, $queryDate, $currentPage, $pageSize)
    {
        $req = new AlibabaAliqinFcSmsNumQueryRequest;
        $req->setBizId($bizId);
        $req->setRecNum($recNum);
        $req->setQueryDate($queryDate);
        $req->setCurrentPage($currentPage);
        $req->setPageSize($pageSize);
        $resp = $this->client->execute($req);

        return $resp;
    }

    /**
     * 获取回执信息
     */
    public function getReceive()
    {
        $req = new TmcMessagesConsumeRequest;
//        $req->setGroupName("vip_user");
        $req->setQuantity("100");
        $resp = $this->client->execute($req);
//
//        dd($resp);


        if (isset($resp->messages->tmc_message)) {
            $list = $resp->messages->tmc_message;
            foreach ($list as $item => $value) {
                Log::info("回执记录id:" . (string)$value->id);
                if ($value->content) {
                    $content = json_decode($value->content);
                    $receive = new Record_Receive();
                    $receive->mobile = $content->receiver;
                    $receive->sendTime = $content->send_time;
                    $receive->bizId = $content->biz_id;
                    $receive->reptTime = $content->rept_time;
                    $receive->receiptLog = json_encode($value->content);
                    $receive->state = $content->state == 1 ? 0 : 2;
                    $receive->confirmLog = json_encode($this->confirmReceive($content->biz_id));
                    if (Record_Receive::where("mobile", $content->receiver)->where("bizId", $content->biz_id)->count() == 0) {
                        $receive->save();
                    }

                }
            }
        }
        Log::info("回执记录:" . json_encode($resp));

        return $resp;
    }


    /**
     * 确认回执信息
     * @param $ids
     * @return mixed|\ResultSet|\SimpleXMLElement
     */
    public function confirmReceive($ids)
    {
        $req = new TmcMessagesConfirmRequest;
        $req->setsMessageIds($ids);
        $resp = $this->client->execute($req);
        Log::info("确认回执信息:" . json_encode($resp));
        return $resp;
    }


    public function getSendError($msg)
    {

        switch ($msg) {

            case "isv.OUT_OF_SERVICE":
                $msg = "业务停机";
                break;
            case "isv.PRODUCT_UNSUBSCRIBE":
                $msg = "产品服务未开通";
                break;
            case "isv.ACCOUNT_NOT_EXISTS":
                $msg = "账户信息不存在";
                break;
            case "isv.ACCOUNT_ABNORMAL":
                $msg = "账户信息异常";
                break;
            case "isv.SMS_TEMPLATE_ILLEGAL":
                $msg = "模板不合法";
                break;
            case "isv.SMS_SIGNATURE_ILLEGAL":
                $msg = "签名不合法";
                break;
            case "isv.MOBILE_NUMBER_ILLEGAL":
                $msg = "业务停机";
                break;
            case "isv.手机号码格式错误":
                $msg = "业务停机";
                break;
            case "isv.MOBILE_COUNT_OVER_LIMIT":
                $msg = "手机号码数量超过限制	";
                break;
            case "isv.TEMPLATE_MISSING_PARAMETERS":
                $msg = "短信模板变量缺少参数	";
                break;
            case "isv.INVALID_PARAMETERS":
                $msg = "参数异常";
                break;
            case "isv.BUSINESS_LIMIT_CONTROL":
                $msg = "触发业务流控限制";
                break;
            case "isv.INVALID_JSON_PARAM":
                $msg = "JSON参数不合法";
                break;
            case "isv.SYSTEM_ERROR":
                $msg = "系统错误";
                break;
            case "isv.BLACK_KEY_CONTROL_LIMIT":
                $msg = "模板变量中存在黑名单关键字。";
                break;
            case "isv.PARAM_NOT_SUPPORT_URL":
                $msg = "不支持url为变量";
                break;
            case "isv.PARAM_LENGTH_LIMIT":
                $msg = "变量长度受限";
                break;
            case "isv.AMOUNT_NOT_ENOUGH":
                $msg = "余额不足";
                break;
            case "Insufficient isv permissions":
                $msg = "平台权限限制";
                break;
            default:
                $msg = "未知错误";
                break;
        }
        return $msg;
    }
}