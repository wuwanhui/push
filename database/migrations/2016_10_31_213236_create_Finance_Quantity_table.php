<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinanceQuantityTable extends Migration
{
    /**
     * 充值记录
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Finance_Quantity', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id');//充值者
            $table->integer('quantity');//数量
            $table->integer('recharge_id')->default(0);//充值记录
            $table->integer('direction')->default(0);//收支方向0收入1支出
            $table->date('expiryDate')->nullable();//有效期止
            $table->integer('manage_id')->default(0);//经办人
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
        Schema::drop('Finance_Quantity');
    }
}
