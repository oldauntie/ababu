<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watchdogs', function (Blueprint $table)
        {
            $table->id();
            $table->char('clinic_id', 36);
            $table->char('user_id', 36)->nullable();
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
};
