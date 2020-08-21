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
        Pet::create([
            'species_id' => '1',
            'clinic_id' => 0,
            'owner_id' => 1,
            'name' => 'Ozzy',
            'sex' => 'M',
            'date_of_birth' => '2012-03-13 23:15:00',
        ]);

        Pet::create([
            'species_id' => '1',
            'clinic_id' => 0,
            'owner_id' => 1,
            'name' => 'Martha',
            'sex' => 'M',
            'date_of_birth' => '2007-07-14 23:15:00',
        ]);

        Pet::create([
            'species_id' => '1',
            'clinic_id' => 0,
            'owner_id' => 2,
            'name' => 'Muddy',
            'sex' => 'M',
            'date_of_birth' => '2001-03-21 23:15:00',
        ]);
    }
}
