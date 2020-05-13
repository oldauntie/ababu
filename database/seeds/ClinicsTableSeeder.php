<?php

use App\Clinic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clinic = Clinic::create(['name' => 'no clinic']);

        // force id to 0
        $clinic->id = 0;
        $clinic->save();

        // reset the auto-increment value
        DB::statement('ALTER TABLE clinics AUTO_INCREMENT = 1');
    }
}
