<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarinaBodyOfWatersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marina_body_of_waters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marina_id');
            $table->unsignedBigInteger('body_of_water_id');
            $table->foreign('marina_id')->references('id')->on('marinas')->onDelete('cascade');
            $table->foreign('body_of_water_id')->references('id')->on('body_of_waters')->onDelete('cascade');
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
        Schema::dropIfExists('marina_body_of_waters');
    }
}
