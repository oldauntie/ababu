<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->string('external_id');
            $table->string('country_id', 2);
            $table->string('name');
            $table->string('company');
            $table->dateTime('date_of_issue');
            $table->dateTime('date_of_withdrawal')->nullable();
            // $table->text('active_substances')->nullable();
            // $table->string('gtin', 14)->nullable();
            // $table->string('atcvet')->nullable();
            // $table->text('prescription_method')->nullable();
            $table->string('pharmaceutical_form')->nullable();
            $table->string('target_species')->nullable();
            $table->text('additional_info')->nullable();

            $table->timestamps();
            $table->unique(['external_id','country_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicines');
    }
}
