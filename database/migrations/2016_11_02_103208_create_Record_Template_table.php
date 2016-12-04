<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordTemplateTable extends Migration
{
    /**
     * 发送模板
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Record_Template', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');//模板名称
            $table->integer('signature_id')->nullable();//签名
            $table->integer('template_id')->nullable();//模板
            $table->string('mobile')->nullable();;//手机号
            $table->string('content')->nullable();;//内容
            $table->string('param');//短信参数
            $table->dateTime('sendTime')->nullable();//定时发送时间
            $table->integer('member_id');//模板所有者
            $table->integer('share')->default(0);//分享0私有1公有，企业内可看
            $table->integer('state')->default(0);//状态0正常1无效
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
        Schema::drop('Record_Template');
    }
}
