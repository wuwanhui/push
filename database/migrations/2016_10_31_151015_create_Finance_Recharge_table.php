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
            $table->integer('userId');//充值者
            $table->float('money');//充值金额
            $table->integer('source');//充值方式0现金1支付宝2微信3银行4其它5转账
            $table->integer('type')->default(0);//充值转账0充值1转账
            $table->integer('direction')->default(0);//收支方向0收入1支出
            $table->string('orderNum')->nullable();//订单号
            $table->integer('liableId')->default(0);//责任人
            $table->integer('parentId')->default(0);//上级支付ID
            $table->integer('state')->default(1);//状态0充值成功1待审核2充值失败
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