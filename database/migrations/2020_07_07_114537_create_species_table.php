<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpeciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('species', function (Blueprint $table) {
            $table->bigInteger('tsn')->unsigned();
            $table->bigInteger('clinic_id')->unsigned();
            $table->string('complete_name');
            $table->string('familiar_name');
            $table->timestamps();

            $table->primary('tsn');
            $table->index('complete_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('species');
    }
}
