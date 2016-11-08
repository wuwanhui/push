<?php

namespace App\Http\SDK;

use App\Models\Receive;
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
        echo $curlPost;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $wholeUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $ret = curl_exec($ch);
        if ($ret === false) {
            var_dump(curl_error($ch));
        } else {
            $json = json_decode($ret);
            if ($json === false) {
                var_dump($ret);
            } else {
                var_dump($json);
            }
        }
        curl_close($ch);
        return;
    }

    // 全部参数使用字符串即可
    function multipleSms($nationCode, $phoneNumbers, $content)
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
            $telElement->nationcode = $nationCode;
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
        echo $curlPost;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $wholeUrl);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $ret = curl_exec($ch);
        if ($ret === false) {
            var_dump(curl_error($ch));
        } else {
            $json = json_decode($ret);
            if ($json === false) {
                var_dump($ret);
            } else {
                var_dump($json);
            }
        }
        curl_close($ch);
        return;
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