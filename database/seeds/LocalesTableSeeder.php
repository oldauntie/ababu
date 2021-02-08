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
            'id' => 'en-US',
            'short_code' => 'en',
            'language' => 'en',
            'description' => 'English (United States)',
            'date_short_format' => 'm/d/Y',
            'date_medium_format' => 'M d, Y',
            'date_long_format' => 'F d, Y',
            'time_short_format' => 'g:i a',
            'time_long_format' => 'H:i:s',
        ]);

        Locale::create([
            'id' => 'en-GB',
            'short_code' => 'en-gb',
            'language' => 'en',
            'description' => 'English (Great Britain)',
            'date_short_format' => 'd/m/Y',
            'date_medium_format' => 'd M Y',
            'date_long_format' => 'd F Y',
            'time_short_format' => 'g:i a',
            'time_long_format' => 'H:i:s',
        ]);

        Locale::create([
            'id' => 'it-IT',
            'short_code' => 'it',
            'language' => 'it',
            'description' => 'Italiano',
            'date_short_format' => 'd/m/Y',
            'date_medium_format' => 'd M Y',
            'date_long_format' => 'd F Y',
            'time_short_format' => 'g:i a',
            'time_long_format' => 'H:i:s',
        ]);

        Locale::create([
            'id' => 'fr-BE',
            'short_code' => 'fr-be',
            'language' => 'fr',
            'description' => 'French (Belgium)',
            'date_short_format' => 'd/m/Y',
            'date_medium_format' => 'd M Y',
            'date_long_format' => 'd F Y',
            'time_short_format' => 'g:i a',
            'time_long_format' => 'H:i:s',
        ]);
    }
}
