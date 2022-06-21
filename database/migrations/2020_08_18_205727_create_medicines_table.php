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
            $table->dateTime('date_of_issue')->nullable();
            $table->dateTime('date_of_suspension')->nullable();
            $table->text('active_substances')->nullable();
            $table->string('gtin')->nullable();
            $table->string('atc')->nullable();
            $table->text('prescription_method')->nullable();
            $table->string('pharmaceutical_form')->nullable();
            $table->text('target_species')->nullable();
            $table->string('therapeutic_group')->nullable();
            $table->string('spc_link')->nullable(); // Summary of Product Characteristics
            $table->text('additional_info')->nullable();

            $table->timestamps();
            $table->softDeletes();
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
