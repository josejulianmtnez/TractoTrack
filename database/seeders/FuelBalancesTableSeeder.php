<?php

namespace Database\Seeders;

use App\Models\FuelBalance;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FuelBalancesTableSeeder extends Seeder
{
    private const INITIAL_BALANCE = 16998.40;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $balance = self::INITIAL_BALANCE;
        $status = $balance < 0 ? 'overdraft' : 'in_favor';

        FuelBalance::create([
            'balance' => $balance,
            'status' => $status,
        ]);
    }
}
