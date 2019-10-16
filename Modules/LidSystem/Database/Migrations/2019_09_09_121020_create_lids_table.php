<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lids', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('frame_id');
            $table->string('first_name')->default('');
            $table->string('second_name')->default('');
            $table->string('patronymic_name')->default('');
            $table->enum('gender', ['man', 'women'])->default('man');
            $table->integer('age')->default(0);
            $table->string('email')->default('');
            $table->string('phone')->default('');
            $table->string('work_place')->default('');
            $table->string('sms_code')->default('');
            $table->enum('game_result', ['wait', 'win', 'lose'])->default('wait');
            $table->integer('session_id')->default(0);
            $table->enum('status', ['on', 'off'])->default('off');
            $table->integer('price')->default(0);
            $table->enum('have_complaint', ['no', 'yes'])->default('no');
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
        Schema::dropIfExists('lids');
    }
}
