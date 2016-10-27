<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplateTagTable extends Migration
{
    public function up()
    {
        Schema::create('template_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');//标签名称
            $table->string('code');//标识
            $table->string('default');//默认值
            $table->integer('templateId');//关联模板
            $table->integer('type')->default(0);//类型0字符
            $table->integer('size')->default(0);//标签大小0无限
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
        Schema::drop('template_tag');
    }
}
