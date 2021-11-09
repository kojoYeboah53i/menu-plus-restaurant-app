<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiningAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dining_areas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restaurant_ID');
            $table->foreign('restaurant_ID')->references('id')->on('restaurants');
            $table->string('name')->unique();
            $table->mediumText('description')->nullable();
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
        Schema::dropIfExists('dining_areas');
    }
}
