<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('pet_id', 36);

            $table->string('reproductive_status', 32)->nullable();
            $table->string('life_style', 32)->nullable();
            $table->boolean('has_pets_in_house')->nullable();
            $table->boolean('has_children_in_house')->nullable();
            $table->string('food', 32)->nullable();
            $table->string('food_consumption', 32)->nullable();
            $table->string('water_consumption', 32)->nullable();
            $table->text('previous_diseases')->nullable();
            $table->text('previous_surgery')->nullable();
            $table->string('previous_veterinary')->nullable();
            $table->boolean('flea_preventive')->nullable();
            $table->boolean('tick_preventive')->nullable();
            $table->boolean('heartworm_preventive')->nullable();
            $table->string('allergies', 255)->nullable();

            $table->boolean('bad_breath')->nullable();
            $table->boolean('lack_of_appetite')->nullable();
            $table->boolean('behavioral_problems')->nullable();
            $table->boolean('limping')->nullable();
            $table->boolean('bleeding_gums')->nullable();
            $table->boolean('loss_of_balance')->nullable();
            $table->boolean('breathing_problems')->nullable();
            $table->boolean('lumps')->nullable();
            $table->boolean('coughing')->nullable();
            $table->boolean('scooting')->nullable();
            $table->boolean('diarrhea')->nullable();
            $table->boolean('scratching')->nullable();
            $table->boolean('ear_issues')->nullable();
            $table->boolean('seems_depressed')->nullable();
            $table->boolean('eye_discharge')->nullable();
            $table->boolean('seizures')->nullable();
            $table->boolean('eyes_bulging')->nullable();
            $table->boolean('shaking_head')->nullable();
            $table->boolean('fainting')->nullable();
            $table->boolean('spraying_house')->nullable();
            $table->boolean('fleas')->nullable();
            $table->boolean('sneezing')->nullable();
            $table->boolean('gagging')->nullable();
            $table->boolean('vomiting')->nullable();
            $table->boolean('hair_loss')->nullable();
            $table->boolean('weakness')->nullable();
            $table->boolean('increased_thirst')->nullable();
            $table->boolean('weight_decreased')->nullable();
            $table->boolean('weight_urination')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pet_id')
                ->references('id')
                ->on('pets')
                ->onDelete('cascade')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_histories');
    }
};
