<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordTable extends Migration
{
    /**
     * 发送记录
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Record', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId');//发送者
            $table->integer('signatureId')->nullable();//签名
            $table->integer('templateId')->nullable();//模板
            $table->string('mobile');//手机号
            $table->string('content');//内容
            $table->string('param');//短信参数
            $table->integer('charging')->default(1);//计费数量
            $table->integer('source')->default(0);//发送来源0在线平台1接口
            $table->text('receipt')->nullable();//回执报告
            $table->integer('state')->default(1);//状态0成功1已提交2失败
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
        Schema::drop('Record');
    }
}