<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarinaImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marina_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('marina_id');
            $table->foreign('marina_id')->references('id')->on('marinas')->onDelete('cascade');
            $table->string('image');
            $table->boolean('status')->default(1);
            $table->smallInteger('position')->nullable();
            $table->boolean('is_crop')->default(1);
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
        Schema::dropIfExists('marina_images');
    }
}
