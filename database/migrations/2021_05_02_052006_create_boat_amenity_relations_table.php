<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatAmenityRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boat_amenity_relations', function (Blueprint $table) {
            $table->unsignedBigInteger('boat_id');
            $table->unsignedBigInteger('amenity_id');
            $table->foreign('boat_id')->references('id')->on('boats')->onDelete('cascade');
            $table->foreign('amenity_id')->references('id')->on('boat_amenities')->onDelete('cascade');
        });
    }

    
            

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boat_amenity_relations');
    }
}
