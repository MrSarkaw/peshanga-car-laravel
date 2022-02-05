<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amers', function (Blueprint $table) {
            $table->id();
            $table->integer('sec_id');
            $table->string('name');
            $table->string('images',1250);
            $table->integer('city_id');
            $table->integer('user_id');
            $table->double('price');
            $table->string('note',255);
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
        Schema::dropIfExists('amers');
    }
}
