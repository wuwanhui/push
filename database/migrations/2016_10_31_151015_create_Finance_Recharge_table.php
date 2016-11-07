<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanceRechargeTable extends Migration
{
    /**
     * 充值记录
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Finance_Recharge', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('memberId');//充值者
            $table->float('money');//充值金额
            $table->integer('source');//充值方式0现金1支付宝2微信3银行4其它
            $table->string('orderNum')->nullable();//订单号
            $table->integer('userId')->default(0);//经办人
            $table->integer('state')->default(1);//状态0成功1待审核2失败
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
        Schema::drop('Finance_Recharge');
    }
}
