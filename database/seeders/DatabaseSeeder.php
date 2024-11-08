<?php

namespace Database\Seeders;

use App\Models\Flatbed;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(FlatbedsTableSeeder::class);
        $this->call(TrucksTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
