<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *发送模板
 * @package App\Models
 */
class Record_Template extends Model
{
    use SoftDeletes;


    protected $table = "Record_Template";
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
            'name.required' => '模板名称不能为空',
        ];
    }


    /**
     *签名
     */
    public function signature()
    {
        return $this->belongsTo('App\Models\Supplier_Resource_Signature', "signatureId");
    }


    /**
     *模板
     */
    public function template()
    {
        return $this->belongsTo('App\Models\Supplier_Resource_Template', "templateId");
    }


    /**
     *模板创建者
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', "userId");
    }

}
