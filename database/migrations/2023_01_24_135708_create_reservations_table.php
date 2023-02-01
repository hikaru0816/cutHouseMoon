<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            // テーブル作成
            $table->increments('id');
            // 追加
            $table->integer('no');
            $table->integer('user_id')->unsigned();
            $table->integer('menu_id')->unsigned();
            // 追加
            $table->integer('remaining_time');
            // 追加
            $table->integer('head');
            $table->date('date');
            $table->integer('start_time_id')->unsigned();
            $table->integer('status')->default(0);
            // 外部キー設定
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('menu_id')->references('id')->on('menus');
            $table->foreign('start_time_id')->references('id')->on('start_times');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
