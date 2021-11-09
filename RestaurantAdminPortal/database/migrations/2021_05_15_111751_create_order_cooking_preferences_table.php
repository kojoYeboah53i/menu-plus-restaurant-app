<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderCookingPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_cooking_preferences', function (
            Blueprint $table
        ) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('cooking_preference_id');
            $table->timestamps();
            $table->primary(['order_id', 'cooking_preference_id']);

            $table
                ->foreign('order_id')
                ->references('id')
                ->on('orders');
            $table
                ->foreign('cooking_preference_id')
                ->references('id')
                ->on('cooking_preferences');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_cooking_preferences');
    }
}
