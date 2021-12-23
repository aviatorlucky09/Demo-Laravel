<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeTestimonialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('home_testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('full_name',50)->nullable();
            $table->string('designation',50)->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('via',50)->nullable();
            $table->smallInteger('position')->nullable();
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
        Schema::dropIfExists('home_testimonials');
    }
}
