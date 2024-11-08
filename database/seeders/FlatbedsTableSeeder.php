<?php

namespace Database\Seeders;

use App\Models\Flatbed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FlatbedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        Flatbed::create([
            'license_plate' => '789-GHI',
            'brand' => $faker->company,
            'model' => 'Model 1',
        ]);

        Flatbed::create([
            'license_plate' => '101-JKL',
            'brand' => $faker->company,
            'model' => 'Model 2',
        ]);
    }
}
