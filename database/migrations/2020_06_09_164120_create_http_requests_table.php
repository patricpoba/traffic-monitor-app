<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHttpRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('http_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('request');
            $table->text('response')->nullable();
            $table->string('url', 1024);
            $table->string('referral_url', 1024)->nullable();
            $table->string('ip', 25);
            $table->text('headers')->nullable();
            $table->string('user_agent');
            $table->string('location')->nullable();
            $table->datetime('deleted_at')->nullable(); 
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
        Schema::dropIfExists('http_requests');
    }
}
