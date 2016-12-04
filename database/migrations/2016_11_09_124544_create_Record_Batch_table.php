<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordBatchTable extends Migration
{
    /**
     * 发送记录
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Record_Batch', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('memberId');//发送者
            $table->integer('signature_id')->nullable();//签名
            $table->integer('template_id')->nullable();//模板
            $table->string('mobile');//手机号
            $table->string('content');//内容
            $table->string('param');//短信参数
            $table->integer('source')->default(0);//发送来源0在线平台1接口
            $table->dateTime('sendTime')->nullable();//定时发送时间
            $table->integer('state')->default(3);//状态0成功1已提交2失败3待提交4余额不足
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
