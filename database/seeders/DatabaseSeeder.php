<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AbbrevationTableSeeder::class);
        $this->call(SpecalistsTableSeeder::class);
        $this->call(PackageTableSeeder::class);
        $this->call(QuestuionsTableSeeder::class);
    }
}
