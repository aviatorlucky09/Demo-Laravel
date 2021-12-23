<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boats', function (Blueprint $table) {
            $table->id();

            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');

            $table->unsignedBigInteger('boat_type_id')->nullable();
            $table->foreign('boat_type_id')->references('id')->on('boat_types')->onDelete('cascade');

            $table->unsignedBigInteger('marina_id')->nullable();
            $table->foreign('marina_id')->references('id')->on('marinas')->onDelete('cascade');

            $table->string('name',50)->nullable();
            $table->string('listing_title',50)->nullable();
            $table->text('description')->nullable();
            $table->enum('status',['pending', 'approved', 'declined', 'draft'])->default('draft');
            $table->string('address')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('state_id')->nullable();
            $table->string('zipcode',10)->nullable();
            $table->string('latitude',50)->nullable();
            $table->string('longitude',50)->nullable();
            $table->unsignedSmallInteger('passenger_limit')->default(0)->nullable();
            $table->unsignedSmallInteger('min_age')->default(0)->nullable();
            $table->boolean('bookable_online')->default('1');
            $table->json('search_data')->nullable();
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
        Schema::dropIfExists('boats');
    }
}
