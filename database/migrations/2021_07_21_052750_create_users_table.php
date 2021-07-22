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
            $table->id('user_id');
            $table->unsignedBigInteger('user_type_id');
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->char('role', 50);
            $table->char('status', 20);
            $table->text('facebook_profile')->nullable();
            $table->char('phone', 20)->nullable();
            $table->timestamp('start_user_type')->nullable();
            $table->timestamp('end_user_type')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('user_type_id')->references('user_type_id')->on('user_types')->onDelete('cascade');
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
