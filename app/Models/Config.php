<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 系统参数
 * @package App\Models
 */
class Config extends Model
{
    protected $table = 'config';//表名
    protected $primaryKey = "id";//主键
    protected $fillable = [];
    protected $guarded = ['_token'];

    /**
     * 获取应用到请求的验证规则
     *
     * @return array
     */
    public function Rules()
    {
        return [
            'name' => 'required|max:255|min:2',
        ];
    }


    /**
     * 获取应用到请求的验证规则
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => '系统名称为必填项',
        ];
    }
 
}
