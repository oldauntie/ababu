<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        # create root role
        $root = Role::create(['name' => 'root']);
        # force id to 0
        $root->id = 0;
        $root->save();
        
        # create default roles
        # Role::create(['name' => 'admin']);
        # Role::create(['name' => 'veterinarian']);
        */
        # create root role
        Role::create(['id' => 0, 'role' => 'root', 'weight' => 255]);
        # reset the auto-increment value
        DB::statement('ALTER TABLE roles AUTO_INCREMENT = 1');
        
        Role::create(['role' => 'admin', 'weight' => 128]);
        Role::create(['role' => 'veterinarian', 'weight' => 64]);
        Role::create(['role' => 'nurse', 'weight' => 32]);
        # Role::create(['role' => 'operator', 'weight' => 16]);
    }
}
