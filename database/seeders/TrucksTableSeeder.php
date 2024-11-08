<?php

namespace Database\Seeders;

use App\Models\Truck;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrucksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Truck::create([
            'flatbed_id' => 1,
            'license_plate' => '123-ABC',
            'brand' => 'Cascadia',
            'model' => 'Cascadia 126',
            'year' => '2021',
            'color' => 'Blanco',
        ]);

        Truck::create([
            'flatbed_id' => 2,
            'license_plate' => '456-DEF',
            'brand' => 'Volvo',
            'model' => 'VNL 860',
            'year' => '2021',
            'color' => 'Blanco',
        ]);
    }
}
