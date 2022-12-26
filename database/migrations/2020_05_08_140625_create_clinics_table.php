<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('country_id', 2);
            $table->string('serial', 100)->unique();
            $table->string('key', 100);
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('manager', 100)->nullable();
            $table->string('code', 100)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('postcode', 10)->nullable();
            $table->string('city', 64)->nullable();
            $table->string('phone', 32)->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinics', function (Blueprint $table) {
            $table->dropForeign('clinics_country_id_foreign');
        });

        Schema::dropIfExists('clinics');
    }
}
