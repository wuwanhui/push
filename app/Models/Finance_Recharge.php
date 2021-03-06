<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 分销商支付记录
 * @package App\Models
 */
class Finance_Recharge extends Model
{
    use SoftDeletes;


    protected $table = "finance_recharge";
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
            'money' => 'required|max:255|min:1',
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
            'money.required' => '充值金额不能为空',
        ];
    }

    /**
     * 用户信息
     */
   
    public function member()
    {
        return $this->belongsTo('App\Models\Member_User', "member_id");
    }

    /**
     * 经办人
     */
    public function manage()
    {
        return $this->belongsTo('App\Models\Manage_User', 'manage_id');
    }


    /**
     * 用户信息
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\Finance_Recharge', 'parentId');
    }

}
