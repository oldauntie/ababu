<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MedicinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(File::get(base_path() . '/database/seeders/sql/medicines/gb.sql'));
        DB::unprepared(File::get(base_path() . '/database/seeders/sql/medicines/it.sql'));
        DB::unprepared(File::get(base_path() . '/database/seeders/sql/medicines/ug.sql'));
        DB::unprepared(File::get(base_path() . '/database/seeders/sql/medicines/us.sql'));
        DB::unprepared(File::get(base_path() . '/database/seeders/sql/medicines/ke.sql'));
        $this->command->info('Medicines table seeded! (GB, IT, UG, US, KE)');
    }
}
