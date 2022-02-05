<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAshyasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ashyas', function (Blueprint $table) {
            $table->integer('ashya_id')->autoIncrement();
            $table->string('ashya_name');
            $table->string('car',50);
            $table->string('image');
            $table->string('address');
            $table->string('phone_number',11);
            $table->integer('user_id');
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
        Schema::dropIfExists('ashyas');
    }
}
