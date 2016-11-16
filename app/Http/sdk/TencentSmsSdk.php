<?php

namespace App\Http\SDK;

use App\Http\Controllers\Common\RespJson;
use App\Models\Receive;
use Illuminate\Support\Facades\Log;
use stdClass;

/**
 * 短信服务
 * @package App\Http\Service
 */
class TencentSmsSdk
{
    var $url;
    var $sdkappid;
    var $appkey;

    // sdkappid 使用整数即可
    function __construct($sdkappid, $appkey)
    {
        $this->sdkappid = $sdkappid;
        $this->appkey = $appkey;
    }

    // 全部参数使用字符串即可
    function sendSms($phoneNumber, $content, $extend = "", $ext = "")
    {
        $this->url = "https://yun.tim.qq.com/v3/tlssmssvr/sendsms";
        $randNum = rand(100000, 999999);
        $wholeUrl = $this->url . "?sdkappid=" . $this->sdkappid . "&random=" . $randNum;
        echo $wholeUrl;
        $tel = new stdClass();
        $tel->nationcode = "86";
        $tel->phone = $phoneNumber;
        $jsondata = new stdClass();
        $jsondata->tel = $tel;
        $jsondata->type = "0";
        $jsondata->msg = $content;
        $jsondata->sig = md5($this->appkey . $phoneNumber);
        $jsondata->extend = $extend;     // 根据需要添加，一般保持默认
        $jsondata->ext = $ext;        // 根据需要添加，一般保持默认
        $curlPost = json_encode($jsondata);
        $ret = curl($wholeUrl, "POST", $curlPost);
        Log::info("腾讯短信单一发送服务端返回：" . $ret);
        return $ret;
    }

    // 全部参数使用字符串即可
    function multipleSms($phoneNumbers, $content)
    {
        $this->url = "https://yun.tim.qq.com/v3/tlssmssvr/sendmultisms2";
        if (0 == count($phoneNumbers)) {
            return;
        }

        $randNum = rand(100000, 999999);
        $wholeUrl = $this->url . "?sdkappid=" . $this->sdkappid . "&random=" . $randNum;
        echo $wholeUrl . "\n";
        $tel = array();
        for ($i = 0; $i < count($phoneNumbers); $i++) {
            $telElement = new stdClass();
            $telElement->nationcode = "86";
            $telElement->phone = $phoneNumbers[$i];
            $tel[] = $telElement;
        }
        $jsondata = new stdClass();
        $jsondata->tel = $tel;
        $jsondata->type = "0";
        $jsondata->msg = $content;
        $jsondata->sig = $this->calculateSig($this->appkey, $phoneNumbers);
        $jsondata->extend = "";     // 根据需要添加，一般保持默认
        $jsondata->ext = "";        // 根据需要添加，一般保持默认
        $curlPost = json_encode($jsondata);
        $ret = curl($wholeUrl, "POST", $curlPost);
        Log::info("腾讯短信批量发送服务端返回：" . $ret);

        return new RespJson();
    }

    function calculateSig($appkey, $phoneNumbers)
    {
        $cnt = count($phoneNumbers);
        $string = $appkey . $phoneNumbers[0];
        for ($i = 1; $i < $cnt; $i++) {
            $string = $string . "," . $phoneNumbers[$i];
        }
        return md5($string);
    }
}


function test()
{
    //单一发送
    $sender = new TencentSmsSdk(1400017982, "71a68b034642d7d44f8f19c2e80f80d4");
    $sender->sendSms("86", "13983087661", "您的验证为：93894949");

    //批量发送
    $phoneNumbers = array("13983087661", "17783154321");
// 请确保签名和模板审核通过
    $sender->multipleSms("86", $phoneNumbers, "您的验证为：93894949");
}