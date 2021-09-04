<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Role;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rootRole = Role::where('name', 'root')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $veterinarianRole = Role::where('name', 'veterinarian')->first();

        $root = User::create([
            'locale_id' => 'en-US',
            'name' => 'root',
            'email' => 'root@ababu.cloud',
            'password' => Hash::make('ababu'),
        ]);

        // force id to 0
        $root->id = 0;
        $root->save();
        
        // reset the auto-increment value
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');

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
        
        $root->roles()->attach($rootRole);
        $admin->roles()->attach($adminRole);
        $veterinarian->roles()->attach($veterinarianRole);
    }
}
