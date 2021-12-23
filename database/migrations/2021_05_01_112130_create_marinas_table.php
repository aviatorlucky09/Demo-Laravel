<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marinas', function (Blueprint $table) {
            $table->id();

            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies');

            $table->unsignedBigInteger('body_of_water_id')->nullable();
            $table->foreign('body_of_water_id')->references('id')->on('body_of_waters');

            $table->string('name')->nullable();
            $table->string('slug',150)->unique()->nullable();

            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('state_id')->nullable();
            $table->string('zipcode',100)->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('website',150)->nullable();
            $table->string('mobile',25)->nullable();
            $table->string('email',100)->nullable();
            $table->string('phone',25)->nullable();
            $table->text('what_they_offer')->nullable();
            $table->enum('status',['pending','approved','declined'])->default('pending');
            $table->float('commission_pr',4,2)->default(10)->nullable();
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
        Schema::dropIfExists('marinas');
    }
}
