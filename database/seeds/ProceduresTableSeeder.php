<?php

use Illuminate\Database\Seeder;

class ProceduresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(File::get(base_path() . '/database/seeds/sql/VeNom/procedures.sql'));
        $this->command->info('VeNom\procedures table seeded!');
    }
}
