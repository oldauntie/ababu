<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

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

        $password = Str::random(8);

        $root = User::create([
            'locale_id' => 'en-US',
            'name' => 'root',
            'email' => 'root@ababu.cloud',
            'password' => Hash::make($password),
            'email_verified_at' => Carbon::now(),
        ]);

        # force id to 0
        $root->id = 0;
        $root->save();
        
        # reset the auto-increment value
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');

        
        $root->roles()->attach($rootRole);

        $this->command->info('**********************************');
        $this->command->info('*** root@ababu.cloud password ***');
        $this->command->info($password);
        $this->command->info('**********************************');
    }
}
