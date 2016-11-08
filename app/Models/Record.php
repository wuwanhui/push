<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *发送记录
 * @package App\Models
 */
class Record extends Model
{
    use SoftDeletes;


    protected $table = "Record";
    protected $primaryKey = "id";//主键

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];
    protected $guarded = ['_token'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * 获取应用到请求的验证规则
     *
     * @return array
     */
    public function Rules()
    {
        return [
            'mobile' => 'required|min:11',
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
            'mobile.required' => '手机号不能为空',
        ];
    }


    /**
     *签名
     */
    public function signature()
    {
        return $this->belongsTo('App\Models\Supplier_Resource_Signature', "signatureId");
    }


    /**
     *模板
     */
    public function template()
    {
        return $this->belongsTo('App\Models\Supplier_Resource_Template', "templateId");
    }

    /**
     *发送者
     */
    public function member()
    {
        return $this->belongsTo('App\Models\Member', "memberId");
    }

    /**
     *回执报告
     */
    public function receives()
    {
        return $this->hasMany('App\Models\Record_Receive', "bizId", "bizId");
    }

}
