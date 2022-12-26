<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(AnimaliaTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(LocalesTableSeeder::class);

        $this->call(ClinicsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        
        
        $this->call(DiagnosesTableSeeder::class);
        $this->call(DiagnosticTestsTableSeeder::class);
        $this->call(ReasonsTableSeeder::class);
        $this->call(MedicinesTableSeeder::class);
        $this->call(ProceduresTableSeeder::class);
        
        // $this->call(DevelopSeeder::class);
        
    }
}
