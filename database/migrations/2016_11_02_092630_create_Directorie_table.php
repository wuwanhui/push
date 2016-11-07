<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirectorieTable extends Migration
{
    /**
     * 通讯录
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Directorie', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');//姓名
            $table->string('sex');//性别
            $table->string('idCard');//身份证号
            $table->string('birthday');//生日
            $table->string('mobile');//手机号
            $table->string('tel')->nullable();//电话
            $table->string('fax')->nullable();//传真
            $table->string('qq')->nullable();//QQ号
            $table->string('email')->nullable();//电子邮件
            $table->string('addres')->nullable();//联系地址
            $table->string('openId')->nullable();//微信绑定
            $table->integer('share')->default(0);//分享0私有1公有，企业内可看
            $table->integer('memberId');//所有者
            $table->integer('state')->default(0);//状态
            $table->integer('sort')->default(0);//排序
            $table->text('remark')->nullable();//备注
            $table->softDeletes();
            $table->timestamps();

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Directorie');
    }
}
