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
        Schema::create('procedures', function (Blueprint $table)
        {
            $table->id('id');
            $table->string('external_id', 32);
            $table->string('coding', 32);
            $table->string('country_id', 2);
            $table->string('subset', 32);
            $table->string('term_name');
            $table->timestamp('expired_at')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            $table->primary('id');
            $table->unique(['external_id', 'coding', 'country_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procedures');
    }
};
