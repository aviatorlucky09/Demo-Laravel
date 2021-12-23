<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarinaAmenityRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marina_amenity_relations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marina_id');
            $table->unsignedBigInteger('amenity_id');
            $table->foreign('marina_id')->references('id')->on('marinas')->onDelete('cascade');
            $table->foreign('amenity_id')->references('id')->on('marina_amenities')->onDelete('cascade');
            
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
        Schema::dropIfExists('marina_amenity_relations');
    }
}
