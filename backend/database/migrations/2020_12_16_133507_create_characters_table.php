<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('uid'); //ユーザーID
            $table->string('name', 20); //VARCHAR, 長さ指定カラム
            $table->integer('hp'); //HP
            $table->integer('attack'); //攻撃力
            $table->integer('defence'); //防御力
            $table->integer('exp')->default(0); //経験値 初期値0
            $table->integer('level')->default(1); //レベル 初期値Lv.1
            $table->string('thumnailURL', 100); //本サムネイル
            $table->string('pictoURL', 100); //キャラ画像
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
        Schema::dropIfExists('characters');
    }
}
