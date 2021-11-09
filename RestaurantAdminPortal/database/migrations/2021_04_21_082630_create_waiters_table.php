<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaitersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waiters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restaurant_ID');
            $table
                ->foreign('restaurant_ID')
                ->references('id')
                ->on('restaurants');
            $table->string('fullname');
            $table->string('phone_number');
            $table->string('pin')->nullable();
            $table
                ->enum('employment_type', ['casual', 'part-time', 'full-time'])
                ->default('casual');
            $table->enum('on_shift', ['yes', 'no'])->default('no');
            $table->string('profile_pic')->nullable();
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
        Schema::dropIfExists('waiters');
    }
}
