<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template_Tag extends Model
{
    use SoftDeletes;

    protected $table = "template";
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
            // 'name' => 'required|max:255|min:2',
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
            //'name.required' => '产品名称不能为空',
        ];
    }


    /**
     * 合计金额
     */
    public function total()
    {
        return $this->quantity * $this->price;
    }

    /**
     * 分销商
     */
    public function distribution()
    {
        return $this->belongsTo('App\Models\Distribution', 'distributionId');
    }

    /**
     * 所属景区
     */
    public function scenic()
    {
        return $this->belongsTo('App\Models\Scenic', 'scenicId');
    }

    /**
     * 价格项
     */
    public function produits()
    {
        return $this->belongsTo('App\Models\Produits', 'produitsId');
    }


    /**
     * 下单人
     */
    public function member()
    {
        return $this->belongsTo('App\Models\Member', 'memberId');
    }

}
