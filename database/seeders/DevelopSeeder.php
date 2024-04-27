<?php

namespace Database\Seeders;

use App\Models\Clinic;
use App\Models\Examination;
use App\Models\Note;
use App\Models\Owner;
use App\Models\Pet;
use App\Models\Prescription;
use App\Models\Problem;
use App\Models\Role;
use App\Models\Species;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $clinic = Clinic::create([
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
            'email_verified_at' => Carbon::now(),
        ]);
        
        $user = User::create([
            'locale_id' => 'en-US',
            'name' => 'Generic User',
            'email' => 'user@ababu.cloud',
            'password' => Hash::make('ababu'),
            'email_verified_at' => Carbon::now(),
        ]);

        $admin->roles()->attach($adminRole, ['clinic_id' => $clinic->id]);
        $veterinarian->roles()->attach($veterinarianRole, ['clinic_id' => $clinic->id]);




        /**
         * Species
         */
        Species::create([
            'tsn' => '726821',
            'clinic_id' => $clinic->id,
            'familiar_name' => 'Dog',
        ]);

        Species::create([
            'tsn' => '183798',
            'clinic_id' => $clinic->id,
            'familiar_name' => 'Cat',
        ]);


        /**
         * Owners
         */
        $phil = Owner::create([
            'clinic_id' => $clinic->id,
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

        $rory = Owner::create([
            'clinic_id' => $clinic->id,
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

        $paul = Owner::create([
            'clinic_id' => $clinic->id,
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
        $ozzy = Pet::create([
            'species_id' => '1',
            'owner_id' => $phil->id,
            'name' => 'Ozzy',
            'sex' => 'M',
            'date_of_birth' => '2012-03-13 23:15:00',
        ]);


        $muddy = Pet::create([
            'species_id' => '1',
            'owner_id' => $rory->id,
            'name' => 'Muddy',
            'sex' => 'M',
            'date_of_birth' => '2001-03-21 23:15:00',
        ]);

        $martha = Pet::create([
            'species_id' => '1',
            'owner_id' => $paul->id,
            'name' => 'Martha',
            'sex' => 'F',
            'date_of_birth' => '2001-03-21 23:15:00',
        ]);


        /**
         * Problems
         */
        /*
         DB::unprepared(File::get(base_path() . '/database/seeders/sql/develop/Problems.sql'));
        $this->command->info('Problems table seeded!');
        */
        $problem = Problem::create([
            'diagnosis_id' => '326',
            'pet_id' => $ozzy->id,
            'user_id' => $admin->id,
            'active_from' => '2019-03-21 17:28:31',
            'status_id' => 0,
            'key_problem' => 1
        ]);



        /**
         * Presriptions
         */
        /*
        DB::unprepared(File::get(base_path() . '/database/seeders/sql/develop/Prescriptions.sql'));
        $this->command->info('Prescriptions table seeded!');
        */
        Prescription::create([
            'medicine_id' => 1,
            'problem_id' => $problem->id,
            'pet_id' => $ozzy->id,
            'user_id' => $admin->id,
            'quantity' => 1,
            'dosage' => 'one a day',
            'in_evidence' => 0,
            'notes' => 'these are simple notes',
            'print_notes' => 1,
            'created_at' => '2020-08-02 22:00:00'
        ]);


        /**
         * Exmaination
         */
        /*
        DB::unprepared(File::get(base_path() . '/database/seeders/sql/develop/Examinations.sql'));
        $this->command->info('Examinations table seeded!');
        */
        Examination::create([
            'diagnostic_test_id' => '13379',
            'problem_id' => $problem->id,
            'pet_id' => $ozzy->id,
            'user_id' => $admin->id,
            'result' => 'A small problem',
            'medical_report' => 'a Medical report',
            'is_pathologic' => 1,
            'in_evidence' => 1,
            'notes' => 'Some notes to be printed',
            'print_notes' => 1,
            'created_at' => '2020-09-24 02:40:17',
            'updated_at' => '2020-09-24 02:40:17',
        ]);


        /**
         * Notes
         */
        /*
        DB::unprepared(File::get(base_path() . '/database/seeders/sql/develop/Notes.sql'));
        $this->command->info('Notes table seeded!');
        */
        Note::create([
            'pet_id' => $ozzy->id,
            'user_id' => $admin->id,
            'note_text' => 'just another test... to prove nothing',
            'created_at' => '2020-09-24 11:01:14',
            'updated_at' => '2020-09-24 11:01:14',
        ]);


        $this->command->info('*** WARNING! YOU ARE SEEDING DEVELOPMENT DATA ***');
    }
}
