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
        Schema::create('pets', function (Blueprint $table)
        {
            $table->uuid('id')->primary();
            // $table->bigInteger('clinic_id')->unsigned();
            $table->bigInteger('species_id')->unsigned();
            $table->char('owner_id', 36);
            $table->string('breed')->nullable();
            $table->string('name', 100);
            $table->char('sex', 1);
            $table->dateTime('date_of_birth');
            $table->dateTime('date_of_death')->nullable();
            $table->text('description')->nullable();
            $table->string('color', 100)->nullable();
            $table->string('distinguishing_mark', 100)->nullable();
            $table->string('microchip', 64)->nullable();
            $table->string('microchip_location', 100)->nullable();
            $table->string('tatuatge', 64)->nullable();
            $table->string('tatuatge_location', 100)->nullable();
            $table->string('reproductive_status', 64)->nullable();
            $table->string('life_style', 64)->nullable();
            $table->boolean('pets_in_house')->nullable();
            $table->boolean('children_in_house')->nullable();
            $table->string('food', 64)->nullable();
            $table->text('previous_diseases')->nullable();
            $table->text('surgery')->nullable();
            // @todo: $table->string('previous_veterinary', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();

            // @todo @delete me ???
            /*
            $table->foreign('clinic_id')
                ->references('id')
                ->on('clinics')
                ->onDelete('cascade')
                ->onUpdate('no action');
            */
            $table->foreign('species_id')
                ->references('id')
                ->on('species')
                ->onDelete('restrict')
                ->onUpdate('no action');
            $table->foreign('owner_id')
                ->references('id')
                ->on('owners')
                ->onDelete('cascade')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pets', function ($table)
        {
            $table->dropForeign('pets_owner_id_foreign');
            $table->dropForeign('pets_species_id_foreign');
            // $table->dropForeign('pets_clinic_id_foreign');
        });

        Schema::dropIfExists('pets');
    }
};
