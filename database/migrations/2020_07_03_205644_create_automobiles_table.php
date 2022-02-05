<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutomobilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automobiles', function (Blueprint $table) {
            $table->integer('auto_id')->autoIncrement();
            $table->string('menu')->nullable();
            $table->integer('sec_id');
            $table->string('name',50);
            $table->year('model');
            $table->string('plate_number',6);
            $table->string('city_name',15);
            $table->double('price');
            $table->string('images',1250);
            $table->string('mobile_number',11);
            $table->text('note');
            $table->integer('comp_id');
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
        Schema::dropIfExists('automobiles');
    }
}
