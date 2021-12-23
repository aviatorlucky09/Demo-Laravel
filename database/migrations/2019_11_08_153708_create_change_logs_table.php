<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChangeLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable()->default(null);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('admin_id')->nullable()->default(null);
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
            $table->string('class_name')->nullable()->index();
            $table->string('field_name')->nullable();
            $table->string('class_id')->nullable()->index(); 
            $table->string('old_value')->nullable();
            $table->string('new_vale')->nullable();
            $table->string('flag')->default('');
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
        Schema::dropIfExists('change_logs');
    }
}
