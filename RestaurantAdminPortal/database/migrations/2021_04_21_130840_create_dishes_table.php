<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_ID');
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->mediumText('ingredients');
            $table->double('price');
            $table->string('currency');
            $table->string('chef_note')->nullable();
            $table->string('images')->nullable();
            $table->timestamps();

            $table->foreign('menu_ID')->references('id')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dishes');
    }
}
