<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier_Resource_Signature extends Model
{
    use SoftDeletes;


    protected $table = "Supplier_Resource_Signature";
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
            'name' => 'required|max:10|unique:Supplier_Resource_Signature|min:2',

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
            'name.required' => '签名不能为空',
            'name.unique' => '签名已存在',
        ];
    }

    /**
     * 所属资源
     */
    public function resource()
    {
        return $this->belongsTo('App\Models\Supplier_Resource', 'resourceId');
    }

    /**
     * 所属企业
     */
    public function enterprise()
    {
        return $this->belongsTo('App\Models\Enterprise', 'enterpriseId');
    }


}
