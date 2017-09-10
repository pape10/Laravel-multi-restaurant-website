<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->required();
            $table->string('email')->required();
            $table->string('phone')->required();
            $table->text('order_det')->required();
            $table->string('delivery_time')->required();
            $table->date('delivery_date')->required();
            $table->string('ocn')->required();
            $table->integer('total')->required();
            $table->integer('discount')->nullable();
            $table->integer('after_discount')->required();
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
        Schema::dropIfExists('orders');
    }
}
