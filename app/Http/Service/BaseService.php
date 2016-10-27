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
            if ($this->config == null) {
                $this->config = Config::first();
            }
            if ($this->enterprise == null) {
                $this->enterprise = Enterprise::first();
            }
            if ($this->user == null) {
                $this->user = Auth::user();
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
     *获取用户信息
     * @param $key
     * @return mixed
     */
    public function user($key)
    {
        if ($this->user) {
            return $this->user->$key;
        }
    }


    /**
     *获取企业信息
     * @param $key
     * @return mixed
     */
    public function enterprise($key)
    {
        if ($this->enterprise) {
            return $this->enterprise->$key;
        }
    }


    /**
     * 获取企业参数配置
     * @param $key
     * @return mixed
     */
    public function config($key)
    {
        if ($this->config) {
            return $this->config->$key;
        }
    }


}