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
            'country_id' => 'gb',
            'name' => 'Develop Clinic',
            'description' => 'A clinic description goes here',
            'manager' => 'Justin A. Manager',
            'code' => 'ACDC-0003',
            'address' => 'Gibbon Street',
            'postcode' => 'PL4 8BT',
            'city' => 'Plymouth',
            'phone' => '055959243',
            'email' => 'info@developclinic.ac.uk',
            'website' => 'www.developclinic.ac.uk',
            'serial' => Str::random(8),
            'key' => Str::random(8),
            'description' => 'Develop Clinic Description',
        ]);
        


        /**
         * Creating Users
         */
        $adminRole = Role::where('name', 'admin')->first();
        $veterinarianRole = Role::where('name', 'veterinarian')->first();

        $admin = User::create([
            'locale_id' => 'en-GB',
            'registration' => 'GB-REG-3',
            'mobile' => '3480000000',
            'name' => 'Admin User',
            'email' => 'admin@ababu.cloud',
            'password' => Hash::make('ababu'),
            'email_verified_at' => Carbon::now(),
        ]);

        $veterinarian = User::create([
            'locale_id' => 'it-IT',
            'registration' => 'IT-REG-3',
            'mobile' => '3470000000',
            'name' => 'Veterinarian',
            'email' => 'veterinarian@ababu.cloud',
            'password' => Hash::make('ababu'),
        ]);

        $user = User::create([
            'locale_id' => 'en-US',
            'name' => 'Generic User',
            'email' => 'user@ababu.cloud',
            'password' => Hash::make('ababu'),
        ]);

        $admin->roles()->attach($adminRole, ['clinic_id' => 1]);
        $veterinarian->roles()->attach($veterinarianRole, ['clinic_id' => 1]);



        
        /**
         * Species
         */
        Species::create([
            'tsn' => '726821',
            'clinic_id' => 1,
            'familiar_name' => 'Dog',
        ]);

        Species::create([
            'tsn' => '183798',
            'clinic_id' => 1,
            'familiar_name' => 'Cat',
        ]);


        /**
         * Owners
         */
        Owner::create([
            'id' => 1,
            'clinic_id' => 1,
            'country_id' => 'ie',
            'firstname' => 'Phil',
            'lastname' => 'Lynott',
            'email' => 'phil.lynott@ababu.cloud',
            'phone_primary' => '+41 000 0 0000',
            'phone_secondary' => '+41 348 0 0000',
            'address' => 'Front Sea Rd.',
            'postcode' => 'D03 1X2Y',
            'city' => 'Dublin',
            'ssn' => 'DVN-PHY',
        ]);

        Owner::create([
            'id' => 2,
            'clinic_id' => 1,
            'country_id' => 'ie',
            'firstname' => 'Rory',
            'lastname' => 'Gallagher',
            'email' => 'rory.gallagher@ababu.cloud',
            'phone_primary' => '+41 000 1 1000',
            'phone_secondary' => '+41 348 1 1000',
            'address' => 'Abbot Rd.',
            'postcode' => 'K03 1X2Y',
            'city' => 'Cork',
            'ssn' => 'DVN-ROR',
        ]);

        Owner::create([
            'id' => 3,
            'clinic_id' => 1,
            'country_id' => 'gb',
            'firstname' => 'Paul',
            'lastname' => 'Mcartney',
            'email' => 'paul.mccartney@ababu.cloud',
            'phone_primary' => '+44 000 2 2000',
            'phone_secondary' => '+44 348 2 2000',
            'address' => 'Abbey Rd.',
            'postcode' => 'LND 1X2Y',
            'city' => 'London',
            'ssn' => 'DVN-PAU',
        ]);

        /**
         * Pets
         */
        Pet::create([
            'species_id' => '1',
            'clinic_id' => 1,
            'owner_id' => 1,
            'name' => 'Ozzy',
            'sex' => 'M',
            'date_of_birth' => '2012-03-13 23:15:00',
        ]);

        Pet::create([
            'species_id' => '1',
            'clinic_id' => 1,
            'owner_id' => 1,
            'name' => 'Martha',
            'sex' => 'M',
            'date_of_birth' => '2007-07-14 23:15:00',
        ]);

        Pet::create([
            'species_id' => '1',
            'clinic_id' => 1,
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
        DB::unprepared(File::get(base_path() . '/database/seeds/sql/develop/Problems.sql'));
        $this->command->info('Problems table seeded!');

        /**
         * Presriptions
         */
        DB::unprepared(File::get(base_path() . '/database/seeds/sql/develop/Prescriptions.sql'));
        $this->command->info('Prescriptions table seeded!');


        /**
         * Exmaination
         */
        DB::unprepared(File::get(base_path() . '/database/seeds/sql/develop/Examinations.sql'));
        $this->command->info('Examinations table seeded!');


        /**
         * Notes
         */
        DB::unprepared(File::get(base_path() . '/database/seeds/sql/develop/Notes.sql'));
        $this->command->info('Notes table seeded!');


        $this->command->info('*** WARNING! YOU ARE SEEDING DEVELOPMENT DATA ***');
    }
}
