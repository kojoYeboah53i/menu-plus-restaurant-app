<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkingAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('working_areas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('waiter_ID');
            $table->foreign('waiter_ID')->references('id')->on('waiters');
            $table->unsignedBigInteger('dining_area_ID');
            $table->foreign('dining_area_ID')->references('id')->on('dining_areas');
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
        Schema::dropIfExists('working_areas');
    }
}
