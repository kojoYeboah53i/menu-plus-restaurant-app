<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderSaucesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_sauces', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('sauce_id');
            $table->timestamps();
            $table->primary(['order_id', 'sauce_id']);

            $table
                ->foreign('order_id')
                ->references('id')
                ->on('orders');
            $table
                ->foreign('sauce_id')
                ->references('id')
                ->on('sauces');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_sauces');
    }
}
