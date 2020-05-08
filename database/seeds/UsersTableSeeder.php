<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', 'admin')->first();
        $medicRole = Role::where('name', 'medic')->first();

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@ababu.cloud',
            'password' => Hash::make('ababu'),
        ]);

        $medic = User::create([
            'name' => 'Medic',
            'email' => 'medic@ababu.cloud',
            'password' => Hash::make('ababu'),
        ]);

        $user = User::create([
            'name' => 'Generic User',
            'email' => 'user@ababu.cloud',
            'password' => Hash::make('ababu'),
        ]);
        
        $admin->roles()->attach($adminRole);
        $medic->roles()->attach($medicRole);
    }
}
