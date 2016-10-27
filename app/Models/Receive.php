<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 短信回执
 * @package App\Models
 */
class Receive extends Model
{
    use SoftDeletes;


    protected $table = "Receive";
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
            'name.required' => '产品名称不能为空',
        ];
    }

    /**
     * 所属供应商
     */
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplierId');
    }

    /**
     * 原始产品
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'productId');
    }


    /**
     * 所属景区
     */
    public function scenic()
    {
        return $this->belongsTo('App\Models\Scenic', 'scenicId');
    }

}
