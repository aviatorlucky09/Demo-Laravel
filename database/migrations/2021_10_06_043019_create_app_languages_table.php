<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_languages', function (Blueprint $table) {
            $table->id();
            $table->string('lang_key')->unique();
            $table->string('lang_name')->default('');
            $table->string('data_type')->default('string');
            $table->text('data_value')->nullable();
            $table->string('page')->nullable();
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
        Schema::dropIfExists('app_languages');
    }
}
