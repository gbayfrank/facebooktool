<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFbAccFanPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fb_acc_fan_page', function (Blueprint $table) {
            $table->unsignedBigInteger('fb_account_id');
            $table->unsignedBigInteger('fan_page_id');

            $table->primary(['fb_account_id', 'fan_page_id']);
            $table->foreign('fb_account_id')->references('fb_account_id')->on('facebook_accounts')->onDelete('cascade');
            $table->foreign('fan_page_id')->references('fan_page_id')->on('fan_pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fb_acc_fan_page');
    }
}
