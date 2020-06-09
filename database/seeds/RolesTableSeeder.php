<?php

use Illuminate\Database\Seeder;
use App\Role;
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
        // create root role
        $root = Role::create(['name' => 'root']);
        // force id to 0
        $root->id = 0;
        $root->save();
        // reset the auto-increment value
        DB::statement('ALTER TABLE roles AUTO_INCREMENT = 1');

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'veterinarian']);
    }
}
