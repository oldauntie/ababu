<?php

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
        DB::unprepared(File::get(base_path() . '/database/seeds/sql/medicines/medicines.sql'));
        $this->command->info('Medicines table seeded! (GB, IT)');
    }
}
