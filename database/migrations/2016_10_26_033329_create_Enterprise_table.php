<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnterpriseTable extends Migration
{
    public function up()
    {
        Schema::create('enterprise', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');//全称
            $table->string('abbreviation');//简称
            $table->string('linkMan');//联系人
            $table->string('mobile');//手机号
            $table->string('tel');//电话
            $table->string('fax');//传真
            $table->string('qq');//QQ号
            $table->string('email');//电子邮件
            $table->string('addres');//联系地址
            $table->integer('createId')->default(0);//增加者
            $table->integer('editId')->default(0);//编辑者
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
        Schema::drop('enterprise');
    }
}
