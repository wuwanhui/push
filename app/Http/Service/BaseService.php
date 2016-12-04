<?php

namespace App\Http\Service;

use App\Models\Config;
use Illuminate\Support\Facades\Auth;

/**
 * 基础服务
 * @package App\Http\Service
 */
class BaseService
{
    private $config = null;
    private $enterprise = null;
    private $manage = null;
    private $member = null;

    public function __construct()
    {

    }

    /**
     *获取用户信息
     * @param $key
     * @return mixed
     */
    public function user($key = null)
    {
        $this->member = Auth::guard("member")->user();
        if ($key) {
            return $this->member->$key;
        } else {
            return $this->member;
        }
    }

    /**
     *获取用户信息
     * @param $key
     * @return mixed
     */
    public function manage($key = null)
    {

        $this->manage = Auth::guard("manage")->user();
        if ($key) {
            return $this->manage->$key;
        } else {
            return $this->manage;
        }

    }

    /**
     *获取用户信息
     * @param $key
     * @return mixed
     */
    public function member($key = null)
    {
        $this->member = Auth::guard("member")->user();
        if ($key) {
            return $this->member->$key;
        } else {
            return $this->member;
        }
    }


    /**
     * 获取企业参数配置
     * @param $key
     * @return mixed
     */
    public function config($key = null)
    {

        if (!$this->config) {
            $this->config = Config::first();
        }
        if ($key) {
            return $this->config->$key;
        } else {
            return $this->config;
        }
    }


}