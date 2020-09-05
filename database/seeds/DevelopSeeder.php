<?php

use App\Clinic;
use App\Owner;
use App\Pet;
use App\Role;
use App\Species;
use App\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class DevelopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Black Clinic
         */
        Clinic::create([
            'country_id' => 'it',
            'name' => 'Black Clinic',
            'serial' => Str::random(8),
            'key' => Str::random(8),
            'description' => 'Black Clinic',
        ]);

        /**
         * Black User
         */
        $adminRole = Role::where('name', 'admin')->first();
        $black_user = User::create([
            'locale_id' => 'en-GB',
            'name' => 'Black User',
            'email' => 'black@ababu.cloud',
            'password' => Hash::make('ababu'),
            'email_verified_at' => Carbon::now(),
        ]);

        $black_user->roles()->attach($adminRole, ['clinic_id' => 1]);

        /**
         * Species
         */
        Species::create([
            'tsn' => '171341',
            'clinic_id' => 0,
            'familiar_name' => 'Wolf',
        ]);

        Species::create([
            'tsn' => '171341',
            'clinic_id' => 1,
            'familiar_name' => 'Wolf Wolf',
        ]);

        /**
         * Owners
         */
        Owner::create([
            'id' => 1,
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
            'id' => 2,
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

        Owner::create([
            'id' => 3,
            'clinic_id' => 1,
            'country_id' => 'gb',
            'firstname' => 'Paul',
            'lastname' => 'Mcartney',
            'address' => 'Abbey Rd.',
            'postcode' => 'LND 1X2Y',
            'city' => 'London',
            'phone' => '+44 000 0 0000',
            'mobile' => '+44 348 0 0000',
            'email' => 'paul.mccartney@ababu.cloud',
        ]);

        /**
         * Pets
         */
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

        Pet::create([
            'species_id' => '1',
            'clinic_id' => 1,
            'owner_id' => 3,
            'name' => 'Martha',
            'sex' => 'F',
            'date_of_birth' => '2001-03-21 23:15:00',
        ]);


        /**
         * Problems
         */
        DB::unprepared(File::get(base_path() . '/database/seeds/sql/Problems.sql'));
        $this->command->info('Problems table seeded!');

        /**
         * Presriptions
         */
        // DB::unprepared(File::get(base_path() . '/database/seeds/sql/Prescriptions.sql'));
        // $this->command->info('Prescriptions table seeded!');

        $this->command->info('*** WARNING! YOU ARE SEEDING DEVELOPMENT DATA ***');
    }
}
