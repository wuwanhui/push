<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Signature extends Model
{
    use SoftDeletes;


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
            'name' => 'required|max:8|min:2',
        ];
    }

    public function EditRules()
    {
        return [
            //  'name' => 'required|max:10|unique:Supplier_Resource_Signature|min:2',

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
     * 经办人
     */
    public function Manage()
    {
        return $this->belongsTo('App\Models\Manage_User', 'manage_id');
    }

}
