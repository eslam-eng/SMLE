<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use SLIM\Package\App\Models\Package;
use SLIM\Question\App\Models\Question;
use SLIM\Specialization\App\Models\Specialization;
use SLIM\Subspecialties\App\Models\SubSpecialties;

class QuestuionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 30) as $index) {
            Question::create([
                'question'=>'Question number' . $index,
                'answer_a'=>fake()->sentence,
                'answer_b'=>fake()->sentence,
                'answer_c'=>fake()->sentence,
                'answer_d'=>fake()->sentence,
                'model_answer'=>\Arr::random(['A','B','C','D']),
                'question_mark'=>fake()->numberBetween(1,8),
                'description'=>fake()->sentence,
                'is_active'=>true,
                'specialist_id'=>Specialization::query()->inRandomOrder()->first()->id,
                'sub_specialist_id'=>SubSpecialties::query()->inRandomOrder()->first()->id,
                'level'=>fake()->numberBetween(1,3),
            ]);
        }
    }
}
