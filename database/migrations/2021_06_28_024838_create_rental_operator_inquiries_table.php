<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalOperatorInquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rental_operator_inquiries', function (Blueprint $table) {
            $table->id();   
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('company_id')->nullable()->default(null);
            $table->string('company_name')->nullable();
            $table->string('email_id')->nullable();
            $table->foreignId('government_document_id')->nullable();
            $table->foreign('government_document_id')->references('id')->on('government_documents');
            $table->string('government_document')->nullable();
            $table->string('address')->nullable();
            $table->string('contact_number',50)->nullable();
            $table->string('street',50)->nullable();
            $table->string('city',50)->nullable();
            $table->string('state',50)->nullable();
            $table->string('zipcode',10)->nullable();
            $table->string('latitude',25)->nullable();
            $table->string('longitude',25)->nullable();
            $table->text('about_company')->nullable();
            $table->enum('status',['in-review','pending', 'approved', 'declined'])->default('in-review');
            $table->text('status_note')->nullable();
            $table->text('action_history')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable()->default(null);
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
        Schema::dropIfExists('rental_operator_inquiries');
    }
}
