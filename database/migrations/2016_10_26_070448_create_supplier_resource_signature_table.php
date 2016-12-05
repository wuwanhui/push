<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierResourceSignatureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_resource_signature', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');//签名名称
            $table->integer('resource_id');//所属资源
            $table->integer('enterprise_id')->default(0);//所属企业为空可通用
            $table->string('number');//签名编号
            $table->integer('manage_id')->default(0);//经办人
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
        Schema::drop('supplier_resource_signature');
    }
}
