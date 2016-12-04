<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier_Resource extends Model
{
    use SoftDeletes;


    protected $table = "supplier_resource";
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
            'name.required' => '资源名称不能为空',
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
     * 经办人
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'userId');
    }


    /**
     *签名
     */
    public function signatures()
    {
        return $this->hasMany('App\Models\Supplier_Resource_Signature', "resourceId");
    }

    /**
     *模板
     */
    public function templates()
    {
        return $this->hasMany('App\Models\Supplier_Resource_Template', "resourceId");
    }
}
