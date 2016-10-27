<?php

namespace App\Http\Service;

use QianfanClient;

/**
 *
 * @package App\Http\Service
 */
class QianfanService
{

    private $client = null;

    public function __construct()
    {
        $this->client = new QianfanClient;
    }


    public function addOrder($addOrderRequest)
    {
        $result = $this->client->addOrder($addOrderRequest);;
        return $result;
    }


    /**
     * 获取可销售产品
     * @return mixed
     */
    public function getResources()
    {
        $result = $this->client->getResources();
        return $result;
    }
}