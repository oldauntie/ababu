<?php

use Illuminate\Database\Seeder;
use App\Owner;

class OwnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Owner::create([
            'clinic_id' => 0,
            'country_id' => 'ie',
            'firstname' => 'Phil',
            'lastname' => 'Lynott',
            'address' => 'Abbot Rd.',
            'postcode' => 'D03 1X2Y',
            'city' => 'Dublin',
            'phone' => '+41 000 0 0000',
            'mobile' => '+41 348 0 0000',
            'email' => 'phil.lynott@ababu.cloud',
        ]);

        Owner::create([
            'clinic_id' => 0,
            'country_id' => 'ie',
            'firstname' => 'Rory',
            'lastname' => 'Gallagher',
            'address' => 'Abbot Rd.',
            'postcode' => 'K03 1X2Y',
            'city' => 'Cork',
            'phone' => '+41 000 0 0000',
            'mobile' => '+41 348 0 0000',
            'email' => 'phil.lynott@ababu.cloud',
        ]);
    }
}
