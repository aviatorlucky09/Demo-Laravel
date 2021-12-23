<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('faq_category_id');
            $table->foreign('faq_category_id')->references('id')->on('faq_categories');
            $table->string('question')->nullable();
            $table->text('short_answer')->nullable();
            $table->text('answer')->nullable();
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('faq_details');
    }
}
