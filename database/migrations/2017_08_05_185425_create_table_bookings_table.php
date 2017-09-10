<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->required();
            $table->string('email')->required();
            $table->string('phone')->required();
            $table->string('booking_time')->required();
            $table->date('booking_date')->required();
            $table->string('bcn')->required();
            $table->integer('rest_id')->required();
            $table->string('rest_name')->required();
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
        Schema::dropIfExists('table_bookings');
    }
}
