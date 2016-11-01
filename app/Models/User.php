<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;


    protected $table = "User";
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
            'email' => 'required|email|unique:user'
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
//            'email' => 'required|email|unique:user'
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
     *消费记录
     */
    public function records()
    {
        return $this->hasMany('App\Models\Record', "userId");
    }


    /**
     *转账记录
     */
    public function recharges()
    {
        return $this->hasMany('App\Models\Finance_Recharge', "userId");
    }

    /**
     *数量记录
     */
    public function quantitys()
    {
        return $this->hasMany('App\Models\Finance_Quantity', "userId");
    }

    /**
     * @param array $attributes
     */
    public function getBalanceAttribute()
    {
        $quantitys = $this->quantitys()->where("state", 0);
        return $quantitys->where("direction", 0)->sum("quantity") - $quantitys->where("direction", 1)->sum("quantity") - $this->records()->sum("charging");

    }
}
