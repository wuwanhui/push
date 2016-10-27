<?php

namespace App\Http\Service;

use AlibabaAliqinFcSmsNumSendRequest;
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

    public function __construct($appkey ,$secretKey )
    {
        $this->client = new TopClient;
        $this->client->format = "json";
        //请填写自己的app key
        $this->client->appkey = $appkey;
        //请填写自己的app secret
        $this->client->secretKey = $secretKey;
    }


    public function send($mobiles, $param, $templateCode, $sign, $type="normal")
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


}