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
        $owner = Owner::create([
            'clinic_id' => 0,
            'country_id' => 'gb',
            'firstname' => 'Phil',
            'lastname' => 'Lynott',
            'phone' => '+41 000 0 0000',
            'mobile' => '+41 348 0 0000',
            'email' => 'admin@ababu.cloud',
        ]);
    }
}
