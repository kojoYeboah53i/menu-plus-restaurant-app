<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_ID');
            $table->foreign('order_ID')->references('id')->on('orders');
            $table->unsignedBigInteger('dish_ID');
            $table->foreign('dish_ID')->references('id')->on('dishes');
            $table->string('side_dish_IDs');
            $table->string('side_dish_Qtys');
            $table->string('toppings_IDs');
            $table->string('sauce_IDs');
            $table->integer('quantity');
            $table->unsignedBigInteger('cooking_preference_ID');
            $table->foreign('cooking_preference_ID')->references('id')->on('cooking_preferences');
            $table->double('cost');
            $table->string('currency');
            $table->string('special_request');
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
        Schema::dropIfExists('order_items');
    }
}
