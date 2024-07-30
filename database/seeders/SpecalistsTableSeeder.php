<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use SLIM\Specialization\App\Models\Specialization;
use SLIM\Subspecialties\App\Models\SubSpecialties;

class SpecalistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 20) as $index) {
            Specialization::create(['name' => 'specialist'.$index, 'is_active' => true]);
        }
        $specializations = Specialization::all()->pluck('id')->toArray();
        foreach (range(1, 50) as $index) {
            SubSpecialties::create(['name' => 'sub-specialist'.$index, 'is_active' => true,'specialist_id'=>\Arr::random($specializations)]);
        }

    }
}
