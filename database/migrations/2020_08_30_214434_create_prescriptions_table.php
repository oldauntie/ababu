<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->string('medicine_id');
            // $table->bigInteger('diagnosis_id')->unsigned();
            $table->bigInteger('problem_id')->unsigned()->nullable();
            $table->bigInteger('pet_id')->unsigned();
            $table->bigInteger('user_id');
            $table->bigInteger('quantity');
            $table->string('dosage');
            $table->boolean('in_evidence');

            $table->timestamps();

            $table->foreign('problem_id')->references('id')->on('problems')->onDelete('set null');
            $table->foreign('pet_id')->references('id')->on('pets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescriptions');
    }
}
