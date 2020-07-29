<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('clinic_id')->unsigned();
            $table->string('country_id', 2);
            $table->string('firstname');
            $table->string('lastname');
            $table->string('address')->nullable();
            $table->string('postcode', 10)->nullable();
            $table->string('city')->nullable();
            $table->string('ssn')->nullable();
            $table->string('phone', 64);
            $table->string('mobile', 64);
            $table->string('email');

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
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('owners');
    }
}
