<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Member extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    use HasApiTokens;


    protected $table = "Member";
    protected $primaryKey = "id";//主键
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'enterpriseId', 'type', 'state',
    ];

    /**
     * 获取应用到请求的验证规则
     *
     * @return array
     */
    public function Rules()
    {
        return [
            'name' => 'required|max:255|min:2',
            'email' => 'required|email|unique:member'
        ];
    }

    /**
     * 获取应用到请求的验证规则
     *
     * @return array
     */
    public function editRules()
    {
        return [
            'name' => 'required|max:255|min:2',
//            'email' => 'required|email|unique:member'
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
            'name.required' => '用户名不能为空',
            'email.required' => '邮箱不能为空',
            'email.unique' => '邮箱已存在',
        ];
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * 所属企业
     */
    public function enterprise()
    {
        return $this->belongsTo('App\Models\Enterprise', 'enterpriseId');
    }


    /**
     *转账记录
     */
    public function recharges()
    {
        return $this->hasMany('App\Models\Finance_Recharge', "memberId");
    }

    /**
     *充值记录
     */
    public function quantitys()
    {
        return $this->hasMany('App\Models\Finance_Quantity', "memberId");
    }

    /**
     *发票记录
     */
    public function invoices()
    {
        return $this->hasMany('App\Models\Finance_Invoice', "memberId");
    }

    /**
     *消费记录
     */
    public function batch()
    {
        return $this->hasMany('App\Models\Record_Batch', "memberId");
    }


    /**
     * 可用余额
     */
    public function getBalanceMoneyAttribute()
    {
        return 100;
        $quantitys = $this->quantitys()->where("state", 0);
        return $quantitys->where("direction", 0)->sum("quantity") - $quantitys->where("direction", 1)->sum("quantity") - $this->batch->sum("charging");

    }

    /**
     * 可申请发票金额
     */
    public function getInvoiceMoneyAttribute()
    {
        $recharges = $this->recharges()->where("state", 0)->sum("money");
        $invoices = $this->invoices()->where("state", 0)->sum("money");
        return $recharges - $invoices;

    }
}
