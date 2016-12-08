<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *发送批号
 * @package App\Models
 */
class Record_Batch extends Model
{
    use SoftDeletes;


    protected $table = "record_batch";
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
        return $this->belongsTo('App\Models\Supplier_Resource_Signature', "signature_id");
    }


    /**
     *模板
     */
    public function template()
    {
        return $this->belongsTo('App\Models\Supplier_Resource_Template', "template_id");
    }

    /**
     *发送者
     */
    public function member()
    {
        return $this->belongsTo('App\Models\Member_User', "member_id");
    }

    /**
     *发送记录
     */
    public function records()
    {
        return $this->hasMany('App\Models\Record', "batch_id");
    }

    /**
     * 可用余额
     */
    public function getChargingAttribute()
    {
        return $this->records()->sum("charging");

    }

}
