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
        Schema::create('examinations', function (Blueprint $table)
        {
            $table->uuid('id')->primary();
            $table->bigInteger('diagnostic_test_id')->unsigned();
            $table->char('pet_id', 36);
            $table->char('problem_id', 36)->nullable();
            $table->char('user_id', 36)->nullable();
            $table->datetime('examination_date');
            $table->text('result')->nullable();
            $table->text('medical_report')->nullable();
            $table->boolean('is_pathologic');
            $table->boolean('in_evidence');
            $table->text('notes')->nullable();
            $table->boolean('print_notes')->default(false);

            $table->timestamps();

            $table->foreign('problem_id')->references('id')->on('problems')->onDelete('set null');
            $table->foreign('pet_id')->references('id')->on('pets')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
};
