<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->string('name')->nullable();
            $table->foreignId('government_document_id')->nullable();
            $table->foreign('government_document_id')->references('id')->on('government_documents');
            $table->string('government_document')->nullable();
            $table->string('email_id')->nullable();
            $table->string('address')->nullable();
            $table->string('emergency_contact',50)->nullable();
            $table->string('street',50)->nullable();
            $table->string('city',50)->nullable();
            $table->string('state',50)->nullable();
            $table->string('zipcode',10)->nullable();
            $table->string('latitude',25)->nullable();
            $table->string('longitude',25)->nullable();
            $table->text('about_company')->nullable();
            $table->enum('status',['pending', 'approved', 'declined'])->default('pending');
            $table->text('status_note')->nullable();
            $table->string('stripe_account_id',255)->nullable()->default('NULL');
            $table->decimal('commission_percentage',4,2)->default(10)->nullable();
            $table->boolean('stripe_account_status')->nullable()->default(0);
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
        Schema::dropIfExists('companies');
    }
}
