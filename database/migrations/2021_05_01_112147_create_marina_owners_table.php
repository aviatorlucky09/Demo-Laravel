<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarinaOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marina_owners', function (Blueprint $table) {
            $table->unsignedBigInteger('marina_id');
            $table->foreign('marina_id')->references('id')->on('marinas')->onDelete('cascade');
            $table->string('full_name', 55)->nullable();
            $table->string('owner_email', 55)->nullable();
            $table->string('owner_phone', 45)->nullable();
            $table->string('owner_mobile', 25)->nullable();
            $table->string('owner_skype', 45)->nullable();
            $table->string('owner_facebook')->nullable();
            $table->string('owner_twitrer')->nullable();
            $table->string('owner_linkedin')->nullable();
            $table->string('owner_pintrest')->nullable();
            $table->string('i_live_in')->nullable();
            $table->string('i_speak')->nullable();
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
        Schema::dropIfExists('marina_owners');
    }
}
