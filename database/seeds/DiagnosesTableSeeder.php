<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DiagnosesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(File::get(base_path() . '/database/seeds/sql/VeNom/diagnoses.sql'));
        $this->command->info('VeNom\diagnoses table seeded!');
    }
}
