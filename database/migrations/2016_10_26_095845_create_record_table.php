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
        Schema::create('record', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('batch_id')->nullable();//批号
            $table->string('mobile');//手机号r
            $table->string('content');//内容
            $table->string('param');//短信参数
            $table->integer('charging')->default(1);//计费数量
            $table->string('sid')->nullable();//发送编号
            $table->text('receiptLog')->nullable();//回执报告
            $table->dateTime('receiptTime')->nullable();//回执时间
            $table->integer('state')->default(1);//状态0成功1已提交2失败3待提交
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
        Schema::drop('record');
    }
}
