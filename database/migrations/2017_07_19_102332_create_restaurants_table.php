<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestaurantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('restaurant_name')->unique();
            $table->string('restaurant_address');
            $table->string('slug')->unique();
            $table->string('cuisine1')->nullable();
            $table->string('cuisine2')->nullable();
            $table->string('cuisine3')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('image_name')->unique();
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
        Schema::dropIfExists('rests');
    }
}
