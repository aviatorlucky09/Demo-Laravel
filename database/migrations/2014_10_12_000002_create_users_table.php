<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable()->default(null)->index();
            $table->string('first_name');
            $table->string('last_name')->nullable()->default(null);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('country_code',5)->nullable()->default(null);
            $table->string('mobile',10)->nullable()->default(null);
            $table->string('gender')->nullable()->default(null);
            $table->enum('user_type',['0','1'])->default('0')->comment('0=user,1=operator');
            $table->date('birth_date')->nullable();
            $table->string('profile_picture')->nullable()->default(null);
            $table->enum('is_block',['0','1'])->default('0');
            $table->string('provider')->nullable()->default(null);
            $table->string('provider_user_id')->nullable()->default(null);
            $table->tinyInteger('status')->default('0');
            $table->string('stripe_customer_id',255)->nullable()->default(null);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
