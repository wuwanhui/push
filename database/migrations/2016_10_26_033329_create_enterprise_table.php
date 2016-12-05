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
            $table->string('shortName');//简称
            $table->string('linkMan');//联系人
            $table->string('mobile');//手机号
            $table->string('tel')->nullable();//电话
            $table->string('fax')->nullable();//传真
            $table->string('qq')->nullable();//QQ号
            $table->string('email')->nullable();//电子邮件
            $table->string('password');
            $table->string('addres')->nullable();//联系地址
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
        Schema::drop('enterprise');
    }
}
