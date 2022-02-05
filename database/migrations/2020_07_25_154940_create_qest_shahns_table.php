<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQestShahnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qest_shahns', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('phone_number',11);
            $table->string('name',23);
            $table->string('cars',300);
            $table->string('menu',10);
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
        Schema::dropIfExists('qest_shahns');
    }
}
