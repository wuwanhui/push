member_user<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberUserTable extends Migration
{
    public function up()
    {
        Schema::create('member_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('eid')->default(0);//企业关联
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('openId')->nullable();
            $table->integer('state')->default(0);//状态
            $table->integer('sort')->default(0);//排序
            $table->text('remark')->nullable();//备注
            $table->rememberToken();
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
        Schema::drop('member_user');
    }
}
