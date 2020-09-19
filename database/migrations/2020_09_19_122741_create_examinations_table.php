<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExaminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examinations', function (Blueprint $table) {
            $table->id();
            $table->string('diagnostic_test_id');
            $table->bigInteger('problem_id')->unsigned()->nullable();
            $table->bigInteger('pet_id')->unsigned();
            $table->bigInteger('user_id');
            $table->text('result');
            $table->text('medical_report');
            $table->boolean('is_pathologic');
            $table->boolean('in_evidence');
            $table->text('notes')->nullable();
            $table->boolean('print_notes')->default(false);

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
        Schema::dropIfExists('examinations');
    }
}
