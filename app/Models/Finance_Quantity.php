<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 数量充值
 * @package App\Models
 */
class Finance_Quantity extends Model
{
    use SoftDeletes;


    protected $table = "Finance_Quantity";
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
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'userId');
    }


    public function member()
    {
        return $this->belongsTo('App\Models\Member', "memberId");
    }



    /**
     * 充值记录
     */
    public function recharge()
    {
        return $this->belongsTo('App\Models\Finance_Recharge', 'rechargeId');
    }

}
