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
        $roleTruckDriver = Role::create(['name' => 'Chofer']);

        Permission::create([
            'name' => 'viewUsers',
            'description' => 'Permite ver los Usuarios registrados.'
        ])->assignRole($roleAdmin);
        Permission::create([
            'name' => 'viewTrucks',
            'description' => 'Permite ver los Trailers registrados.'
        ])->assignRole($roleAdmin);
        Permission::create([
            'name' => 'viewFlatbeds',
            'description' => 'Permite ver las Plataformas registrados.'
        ])->assignRole($roleAdmin);
        Permission::create([
            'name' => 'viewFuelLoads',
            'description' => 'Permite ver las Cargas de Diesel'
        ])->assignRole([$roleAdmin, $roleTruckDriver]);
        Permission::create([
            'name' => 'selectTruck',
            'description' => 'Permite asignar Trailers a los Choferes.'
        ])->assignRole($roleTruckDriver);    
    }
}
