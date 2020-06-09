<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Role;
use App\User;
use Illuminate\Support\Facades\DB;

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
            'name' => 'Admin User',
            'email' => 'admin@ababu.cloud',
            'password' => Hash::make('ababu'),
        ]);

        $veterinarian = User::create([
            'name' => 'veterinarian',
            'email' => 'veterinarian@ababu.cloud',
            'password' => Hash::make('ababu'),
        ]);

        $user = User::create([
            'name' => 'Generic User',
            'email' => 'user@ababu.cloud',
            'password' => Hash::make('ababu'),
        ]);
        
        $root->roles()->attach($rootRole);
        $admin->roles()->attach($adminRole);
        $veterinarian->roles()->attach($veterinarianRole);
    }
}
