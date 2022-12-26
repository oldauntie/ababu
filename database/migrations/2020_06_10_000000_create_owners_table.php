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
            $table->string('firstname', 100);
            $table->string('lastname', 100);
            $table->string('email');
            $table->string('phone_primary', 32);
            $table->string('phone_secondary', 32)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('postcode', 10)->nullable();
            $table->string('city', 64)->nullable();
            $table->string('ssn', 64)->nullable();

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
