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
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('clinic_id')->unsigned();
            $table->string('name', 100);
            $table->string('description')->nullable();
            $table->string('manager', 100)->nullable();
            $table->string('code', 100)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('postcode', 10)->nullable();
            $table->string('city', 64)->nullable();
            $table->string('phone', 32)->nullable();
            $table->string('email')->nullable();
            $table->timestamps();

            $table->softDeletes();

            $table->foreign('clinic_id')
                ->references('id')
                ->on('clinics')
                ->onDelete('cascade')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
