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
            'name.required' => '名称不能为空',
        ];
    }


    /**
     * 创建者
     */
    public function createUser()
    {
        return $this->belongsTo('App\Models\User', 'createId');
    }

    /**
     * 编辑者
     */
    public function editUser()
    {
        return $this->belongsTo('App\Models\User', 'editId');
    }

    /**
     *供应产品
     */
    public function resources()
    {
        return $this->hasMany('App\Models\Supplier_Resource', "supplierId");
    }


}
