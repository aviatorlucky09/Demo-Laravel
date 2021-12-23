<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreignId('government_document_id')->nullable();
            $table->foreign('government_document_id')->references('id')->on('government_documents');
            $table->string('government_document')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('boat_license_document')->nullable();
            $table->string('company_name')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
            $table->text('about_me')->nullable();
            $table->enum('operator_status',['pending', 'approved', 'declined'])->default('pending');
            $table->text('operator_status_note')->nullable();
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
        Schema::dropIfExists('user_details');
    }
}
