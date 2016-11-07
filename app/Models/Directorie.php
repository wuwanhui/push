<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * 通讯录
 * @package App\Models
 */

class Directorie extends Model
{
    use SoftDeletes;


    protected $table = "Directorie";
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
            'name.required' => '姓名',
        ];
    }

    /**
     *所属用户
     */
    public function member()
    {
        return $this->belongsTo('App\Models\Member', "memberId");
    }

}
