<?php

use App\Clinic;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('locale_id', 10)->after('id');
            $table->string('registration')->nullable()->after('locale_id');
            $table->string('phone', 64)->nullable()->after('registration');
            $table->string('mobile', 64)->nullable()->after('phone');

            $table->foreign('locale_id')->references('id')->on('locales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_locale_id_foreign');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('locale_id');
            $table->dropColumn('registration');
            $table->dropColumn('phone');
            $table->dropColumn('mobile');
        });
    }
}
