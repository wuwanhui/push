<?php
namespace App\Http\Controllers\Common;
/**
 * Created by PhpStorm.
 * User: wuhong
 * Date: 16/10/29
 * Time: 下午2:45
 */
class RespJson
{


    public $code = 0;
    public $msg = "成功";

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $msg
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
    }

    /**
     * @return mixed
     */
    public function getMsg()
    {
        return $this->msg;
    }
}