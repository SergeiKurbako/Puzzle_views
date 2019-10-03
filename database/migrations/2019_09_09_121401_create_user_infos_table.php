<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unique();
            $table->string('first_name')->default('');
            $table->string('second_name')->default('');
            $table->string('patronymic_name')->default('');
            $table->enum('gender', ['man', 'woman'])->default('man');
            $table->integer('age')->default(0);
            $table->string('work_place')->default('');
            $table->string('ip')->default('');
            $table->string('phone')->default('');
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
        Schema::dropIfExists('user_infos');
    }
}
