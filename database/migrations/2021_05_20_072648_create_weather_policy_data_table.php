<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherPolicyDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weather_policy_data', function (Blueprint $table) {
            $table->id();
            $table->string('policy_type')->nullable();
            $table->unsignedTinyInteger('min_charge_hours')->nullable();
            $table->unsignedTinyInteger('remaining_refund_percantage')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('weather_policy_data');
    }
}
