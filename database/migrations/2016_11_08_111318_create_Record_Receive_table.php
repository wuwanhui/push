<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordReceiveTable extends Migration
{
    /**
     * 回执记录
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Record_Receive', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobile');//手机号
            $table->dateTime('sendTime')->nullable();//发送时间
            $table->string('bizId');//批号
            $table->dateTime('reptTime')->nullable();//回执时间

            $table->text('receiptLog')->nullable();//回执报告
            $table->text('confirmLog')->nullable();//回执确认报告
            
            $table->integer('state')->default(0);//状态0成功1已提交2失败3待提交
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
        Schema::drop('Record_Receive');
    }
}
