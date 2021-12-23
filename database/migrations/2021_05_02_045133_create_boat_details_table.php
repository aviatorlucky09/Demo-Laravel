<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boat_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('boat_id');
            $table->foreign('boat_id')->references('id')->on('boats');

            $table->unsignedBigInteger('manufacturer_id');
            $table->foreign('manufacturer_id')->references('id')->on('boat_manufacturers');
            
            $table->char('year',7)->nullable();
            $table->integer('length')->nullable();
            $table->string('horsepower')->nullable();
            $table->enum('fuel_included',['0','1'])->default('1');
            $table->enum('pets_allowed',['0','1','2'])->default('1');
            $table->enum('captains_required',['0','1'])->default('1');
            $table->enum('captains_available',['0','1'])->default('1');
            $table->string('model',45)->nullable();
            $table->string('engine_make',45)->nullable();
            $table->date('rental_season_start')->nullable();
            $table->date('rental_season_end')->nullable();
            $table->enum('towing_allowed',['0','1'])->default('1');
            $table->text('private_notes');
            $table->float('security_deposit')->nullable();
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
        Schema::dropIfExists('boat_details');
    }
}
