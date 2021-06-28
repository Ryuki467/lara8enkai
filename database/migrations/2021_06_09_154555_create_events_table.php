<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id')->unique()->comment('ID');
            $table->string('name',255)->default('')->comment('イベント名');
            $table->string('detail',255)->default('')->comment('詳細');
            $table->integer('max_participant')->comment('最大参加者数');
            $table->integer('category_id')->comment('カテゴリID');
            $table->integer('user_id')->comment('ユーザID');
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
        Schema::dropIfExists('events');
    }
}
