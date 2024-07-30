<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use SLIM\Package\App\Models\Package;
use SLIM\Specialization\App\Models\Specialization;

class PackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 10) as $index) {
            $package = Package::create([
                'name' => 'paid package ' . $index,
                'monthly_price' => fake()->numberBetween(1, 100),
                'yearly_price' => fake()->numberBetween(150, 500),
                'no_limit_for_quiz' => fake()->boolean,
                'no_limit_for_question' => fake()->boolean,
                'for_all_specialities' => false,
                'num_available_quiz' => fake()->numberBetween(1, 15),
                'num_available_question' => fake()->numberBetween(1, 10),
                'is_active' => true,
                'description' => fake()->sentence,
            ]);
            $specialization = Specialization::query()->inRandomOrder()->limit(fake()->numberBetween(1, 10))->pluck('id')->toArray();
            $package->specialist()->sync($specialization);
        }
    }
}
