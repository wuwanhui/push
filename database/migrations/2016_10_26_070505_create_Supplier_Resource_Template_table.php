<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierResourceTemplateTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Supplier_Resource_Template', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');//模板名称
            $table->string('type')->default(0);//模板类型0验证码1通知2营销
            $table->integer('resourceId');//所属资源
            $table->integer('enterpriseId')->nullable();//所属企业为空可通用
            $table->string('number');//模板编号
            $table->string('content');//模板内容
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
        Schema::drop('Supplier_Resource_Template');
    }
}
