<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleDriver = Role::create(['name' => 'Chofer']);

        Permission::create([
            'name' => 'viewUsers',
            'description' => 'Permite ver los Usuarios registrados.'
        ])->assignRole($roleAdmin);
        Permission::create([
            'name' => 'viewFuelLoads',
            'description' => 'Permite ver las Cargas de Diesel'
        ])->assignRole($roleAdmin, $roleDriver);
    }
}
