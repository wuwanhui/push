<?php

class QianfanClient
{
    public $pass = "123456";//接口密码

    public $dispass = "670b14728ad9902aecba32e22fa4f6bd";//分销商密码

    public $dis_code = "fxces";//分销商编码

    public $checkcode = "FX90b6f199-3504-44b5-8825-7c5ca8ada1ad";//分销商检验码

    public function __construct()
    {

    }

    /**
     * @param $addOrderRequest
     */
    public function addOrder($addOrderRequest)
    {
        $url = "http://fxpt.1000fun.com:8082/ticket-web-service/services/ordermsg?wsdl";
        $soap = new SoapClient($url);
        $pass = $this->pass;
        $dis_code = $this->dis_code;
        $checkcode = $this->checkcode;
        $dispass = $this->dispass;
        $content = $addOrderRequest->content;

        $result = $soap->orderSubmit($pass, $dis_code, $checkcode, $dispass, $content);
        print_r($result);
        return $result;
    }

    /**
     * 获取可销售产品
     */
    public function getResources()
    {
        $url = "http://fxpt.1000fun.com:8082/ticket-web-service/services/productsmsg?wsdl";
        $soap = new SoapClient($url);
        $pass = $this->pass;
        $dis_code = $this->dis_code;
        $checkcode = $this->checkcode;
        $dispass = $this->dispass;
        $parms = array('in0' => $pass, 'in1' => $dis_code, 'in2' => $checkcode, 'in3' => $dispass);
        $result = $soap->getAvailableProducts($parms);
        return $result;
    }
}