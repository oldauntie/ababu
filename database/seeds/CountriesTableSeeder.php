<?php

use App\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(File::get(base_path() . '/database/seeds/Countries.sql'));
        $this->command->info('Countries table seeded!');
        /*
        Country::create([
            'id' => 'gb',
            'name' => 'United Kingdom',
            'alpha_3' => 'gbr'
        ]);
        */
    }
}
