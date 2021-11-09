<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCookingPreferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cooking_preferences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dish_ID');
            $table->foreign('dish_ID')->references('id')->on('dishes');
            $table->string('name');
            $table->double('additional_cost');
            $table->string('currency');
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
        Schema::dropIfExists('cooking_preferences');
    }
}
