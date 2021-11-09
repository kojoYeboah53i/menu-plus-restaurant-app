<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->unsignedBigInteger('dinner_ID');
            $table->unsignedBigInteger('waiter_ID');
            $table->double('total_cost');
            $table->string('currency');
            $table->boolean('verified');
            $table->enum('Payment', ['billed', 'not-payed', 'payed']);
            $table->enum('Service', [
                'not-served',
                'entree',
                'main',
                'desert',
                'complete',
            ]);
            $table->timestamps();

            $table
                ->foreign('waiter_ID')
                ->references('id')
                ->on('waiters');
            $table
                ->foreign('dinner_ID')
                ->references('id')
                ->on('dinners');
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
