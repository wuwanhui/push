<?php

namespace App\Http\Service;

use App\Models\Config;
use App\Models\Enterprise;
use Illuminate\Support\Facades\Auth;

/**
 * 基础服务
 * @package App\Http\Service
 */
class BaseService
{
    private $config = null;
    private $enterprise = null;
    private $user = null;

    public function __construct()
    {
        if (Auth::check()) {

            if ($this->user == null) {
                $this->user = Auth::user();
            }
            if ($this->enterprise == null) {
                $this->enterprise = $this->user->enterprise;
            }
            if ($this->config == null) {
                $this->config = $this->enterprise->config;
            }

        }
    }


    /**
     * 获取用户ID
     * @return mixed
     */
    public function uid()
    {
        if ($this->user) {
            return $this->user->id;
        }
    }


    /**
     * 获取企业ID
     * @return mixed
     */
    public function eid()
    {
        if ($this->enterprise) {
            return $this->enterprise->id;
        }
    }

    /**
     *获取用户信息
     * @param $key
     * @return mixed
     */
    public function user($key = null)
    {

        if ($this->user) {
            if ($key) {
                return $this->user->$key;
            } else {
                return $this->user;
            }
        }
    }


    /**
     *获取企业信息
     * @param $key
     * @return mixed
     */
    public function enterprise($key = null)
    {
        if ($this->enterprise) {
            if ($key) {
                return $this->enterprise->$key;
            } else {
                return $this->enterprise;
            }
        }
    }


    /**
     * 获取企业参数配置
     * @param $key
     * @return mixed
     */
    public function config($key = null)
    {

        if ($this->config) {
            if ($key) {
                return $this->config->$key;
            } else {
                return $this->config;
            }
        }
    }


}