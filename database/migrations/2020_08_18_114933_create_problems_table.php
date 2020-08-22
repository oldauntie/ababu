<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('diagnosis_id')->unsigned();
            $table->bigInteger('pet_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('status_id');
            $table->dateTime('active_from');
            $table->boolean('key_problem');
            $table->text('subjective_analysis')->nullable();
            $table->text('objective_analysis')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->unique(['diagnosis_id','pet_id']);

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
        Schema::dropIfExists('problems');
    }
}
