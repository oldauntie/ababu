<?php

use Illuminate\Database\Seeder;
use App\Locale;

class LocalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Locale::create([
            'id' => 'en',
            'language' => 'English',
            'date_short_format' => 'd-m-y',
            'date_long_format' => 'd-m-y',
            'time_short_format' => 'g:i a',
            'time_long_format' => 'H:i:s',
        ]);

        Locale::create([
            'id' => 'it',
            'language' => 'Italiano',
            'date_short_format' => 'd/m/y',
            'date_long_format' => 'd/m/y',
            'time_short_format' => 'g:i a',
            'time_long_format' => 'H:i:s',
        ]);
    }
}
