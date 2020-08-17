<?php

use Illuminate\Database\Seeder;
use App\Species;

class SpeciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $species = Species::create([
            'tsn' => '171341',
            'clinic_id' => 0,
            'familiar_name' => 'Wolf',
        ]);
    }
}
