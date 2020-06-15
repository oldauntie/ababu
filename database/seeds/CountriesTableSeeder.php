<?php

use App\Country;
use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'id' => 'gb',
            'name' => 'United Kingdom',
            'alpha_3' => 'gbr'
        ]);
    }
}
