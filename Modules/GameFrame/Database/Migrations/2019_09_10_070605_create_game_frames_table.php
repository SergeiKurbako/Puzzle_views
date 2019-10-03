<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameFramesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_frames', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('game_id');
            $table->integer('game_rule_id');
            $table->string('url');
            $table->string('ip');
            $table->string('code');
            $table->enum('status', ['on', 'off'])->default('off');
            $table->enum('frame_status', ['on', 'off'])->default('off');
            $table->enum('sms_confirm', ['on', 'off'])->default('on');
            $table->enum('email_confirm', ['on', 'off'])->default('on');
            $table->integer('price')->default(0);
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
        Schema::dropIfExists('game_frames');
    }
}
