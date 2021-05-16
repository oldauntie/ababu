<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('procedure_id')->unsigned();
            $table->bigInteger('pet_id')->unsigned();
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->dateTime('executed_at')->nullable();
            $table->dateTime('recall_at')->nullable();
            $table->string('drug_batch')->nullable();
            $table->dateTime('drug_batch_expires_at')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('print_notes')->default(false);

            $table->timestamps();

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
        Schema::dropIfExists('treatments');
    }
}
