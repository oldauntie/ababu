<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWatchdogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watchdogs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('clinic_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('type', 16);
            
            $table->longText('message')->nullable();
            $table->longText('variables')->nullable();
            $table->tinyInteger('severity')->default(0);
            $table->string('link')->nullable();

            $table->string('request_uri')->nullable();
            $table->string('referer')->nullable();
            $table->string('ip', 50)->nullable();
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
        Schema::dropIfExists('watchdogs');
    }
}
