<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locales', function (Blueprint $table) {
            $table->string('id', 10);
            $table->string('short_code', 10)->unique();
            $table->string('language', 10);
            $table->string('description', 50);
            $table->string('date_short_format', 50);
            $table->string('date_medium_format', 50);
            $table->string('date_long_format', 50);
            $table->string('time_short_format', 50);
            $table->string('time_long_format', 50);

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locales');
    }
}
