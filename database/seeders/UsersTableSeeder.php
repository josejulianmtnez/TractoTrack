<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'truck_id' => null,
            'name' => 'Guadalupe Elvira',
            'last_name' => 'de la Cruz',
            'email' => 'gecb@gmail.com',
            'phone' => '7798745677',
            'password' => Hash::make('12345'),
        ])->assignRole('Admin');

        User::create([
            'truck_id' => 1,
            'name' => 'José Rufino',
            'last_name' => 'de la Cruz Casimiro',
            'email' => 'jrcc@gmail.com',
            'phone' => '7798745677',
            'password' => Hash::make('12345'),
        ])->assignRole('Admin', 'Chofer');
        
        User::create([
            'truck_id' => 2,
            'name' => 'Francisco Alberto',
            'last_name' => 'de la Cruz Berrios',
            'email' => 'facb@gmail.com',
            'phone' => '7798745677',
            'password' => Hash::make('12345'),
        ])->assignRole('Chofer');
    }
}
