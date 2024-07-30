<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use SLIM\Abbreviation\App\Models\Abbreviation;

class AbbrevationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 50) as $index) {
            Abbreviation::create([
                'char_abbreviations' => fake()->title,
                'word_abbreviations' => fake()->sentence,
                'description_abbreviations' => fake()->paragraph,
                'is_active' => true
            ]);
        }
    }
}
