<?php

namespace Database\Seeders;

use App\Models\Clinic;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ClinicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clinic = Clinic::create([
            'id' => '00000000-0000-0000-0000-000000000000',
            'country_id' => 'gb',
            'name' => 'No Clinic',
            'serial' => Str::random(8),
            'key' => Str::random(8),
            'description' => 'Ghost Clinic',
        ]);

    }
}
