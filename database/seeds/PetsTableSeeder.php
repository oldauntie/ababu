<?php

use Illuminate\Database\Seeder;
use App\Pet;

class PetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pet = Pet::create([
            'species_id' => '1',
            'clinic_id' => 0,
            'owner_id' => 1,
            'name' => 'Ozzy',
            'sex' => 'M',
            'date_of_birth' => '2012-03-13 23:15:00',
        ]);
    }
}
