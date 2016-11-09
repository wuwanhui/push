<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierResourceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Supplier_Resource', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');//资源名称
            $table->integer('supplierId');//所属供应商0阿里1腾讯2慢道
            $table->string('appKey')->nullable();//appkey
            $table->text('secretKey')->nullable();//secretKey
            $table->integer('userId')->default(0);//经办人
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
        Schema::drop('Supplier_Resource');
    }
}
