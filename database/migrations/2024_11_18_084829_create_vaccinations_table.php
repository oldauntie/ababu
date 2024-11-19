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
        Schema::create('vaccinations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->char('pet_id', 36);
            $table->char('user_id', 36)->nullable();
            $table->string('vaccine');
            $table->string('batch', 50);
            $table->dateTime('vaccination_date');
            $table->dateTime('booster_date')->nullable();
            $table->date('production_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->string('adverse_reactions')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->foreign('pet_id')->references('id')->on('pets')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vaccinations');
    }
};
