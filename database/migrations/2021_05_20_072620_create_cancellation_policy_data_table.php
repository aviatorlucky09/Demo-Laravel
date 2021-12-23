<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCancellationPolicyDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancellation_policy_data', function (Blueprint $table) {
            $table->id();
            $table->string('policy_type')->nullable();
            $table->unsignedTinyInteger('time')->nullable();
            $table->string('time_type')->nullable();
            $table->unsignedTinyInteger('refund_percentage')->nullable();
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
        Schema::dropIfExists('cancellation_policy_data');
    }
}
