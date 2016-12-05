<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanceInvoiceTable extends Migration
{
    /**
     * 发票申请
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id');//申请者
            $table->float('money');//申请金额
            $table->string('enterprise');//抬头企业
            $table->string('linkMan');//联系人
            $table->string('mobile');//手机号
            $table->string('tel')->nullable();//电话
            $table->string('addres')->nullable();//联系地址
            $table->string('express')->nullable();//快递单号
             $table->integer('manage_id')->default(0);//经办人
            $table->integer('state')->default(1);//状态0已邮寄1待审核2开具失败
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
        Schema::drop('finance_invoice');
    }
}
