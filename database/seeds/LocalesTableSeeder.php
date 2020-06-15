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
        ]);

        Locale::create([
            'id' => 'it',
            'language' => 'Italiano',
        ]);
    }
}
