<?php

use App\Clinic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClinicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clinic = Clinic::create([
                        'country_id' => 'gb', 
                        'name' => 'no clinic', 
                        'serial' => Str::random(8),
                        'key' => Str::random(8),
                        'description' => 'clinic zero',
                        ]);
        
        // force id to 0
        $clinic->id = 0;
        $clinic->save();
        
        // reset the auto-increment value
        DB::statement('ALTER TABLE clinics AUTO_INCREMENT = 1');
    }
}
