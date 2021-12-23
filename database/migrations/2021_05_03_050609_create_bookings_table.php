<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('boat_id');
            $table->foreign('boat_id')->references('id')->on('boats');

            $table->enum('status',['request','payment_request','booked','canceled','refunded'])->default('request');

            $table->dateTime('from_date')->nullable();
            $table->dateTime('to_date')->nullable();
            $table->enum('time_slot',['am','pm','full_day','full_day_am','full_day_pm'])->nullable();
            $table->boolean('is_hourly')->nullable()->default(false);
            $table->tinyInteger('total_time_price')->default(0)->nullable();
            
            

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
        Schema::dropIfExists('bookings');
    }
}
