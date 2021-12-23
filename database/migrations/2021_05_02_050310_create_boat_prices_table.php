<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boat_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('boat_id');
            $table->foreign('boat_id')->references('id')->on('boats');
            $table->enum('day',['MON','TUE','THU','WED','FRI','SAT','SUN'])->nullable();

            $table->boolean('half_day_am')->nullable()->default(0);
            $table->boolean('half_day_pm')->nullable()->default(0);
            $table->boolean('full_day')->nullable()->default(0);
            $table->boolean('hourly')->nullable()->default(0);

            $table->time('hourly_start_hours')->nullable();
            $table->time('hourly_end_hours')->nullable();
            $table->unsignedSmallInteger('hourly_turnaround')->nullable()->default(0);
            $table->float('hourly_price')->nullable();

            $table->float('full_day_price')->nullable();
            $table->time('full_day_start_hours')->nullable();
            $table->time('full_day_end_hours')->nullable();
            $table->unsignedSmallInteger('full_day_turnaround')->nullable()->default(0);

            $table->float('half_day_am_price')->nullable();
            $table->time('half_day_am_start_hours')->nullable();
            $table->time('half_day_am_end_hours')->nullable();
            $table->unsignedSmallInteger('half_day_am_turnaround')->nullable()->default(0);

            $table->float('half_day_pm_price')->nullable();
            $table->time('half_day_pm_start_hours')->nullable();
            $table->time('half_day_pm_end_hours')->nullable();
            $table->unsignedSmallInteger('half_day_pm_turnaround')->nullable()->default(0);

            $table->float('weekend_price')->nullable();
            $table->time('weekend_start_hours')->nullable();
            $table->time('weekend_end_hours')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('boat_prices');
    }
}
