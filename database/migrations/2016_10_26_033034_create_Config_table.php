<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration
{
    public function up()
    {
        Schema::create('Config', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');//平台名称
            $table->string('enterprise');//企业名称
            $table->string('logo')->nullable();//系统Logo
            $table->string('domain')->nullable();//平台地址
            $table->string('assetsDomain')->nullable();//资源地址
            $table->string('tel');//联系电话
            $table->string('fax');//传真
            $table->string('email');//邮箱
            $table->string('qq');//QQ
            $table->string('addres');//地址


            $table->string('weixin_Token');//Token
            $table->string('weixin_AppID');//Appid
            $table->string('wexin_AppSecret');//Secret
            $table->string('wexin_AES');//AES
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
        Schema::drop('Config');
    }
}
