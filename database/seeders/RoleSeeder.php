<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use LaraSnap\LaravelAdmin\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::where('name', 'employee')->first();
        if(!$role){
            $role = new Role;
            $role->name = 'employee';
            $role->label = 'Employee';
            $role->save();
        }

        $role = Role::where('name', 'distributer')->first();
        if(!$role){
            $role = new Role;
            $role->name = 'distributer';
            $role->label = 'Distributer';
            $role->save();
        }

        $role = Role::where('name', 'moderntrade')->first();
        if(!$role){
            $role = new Role;
            $role->name = 'moderntrade';
            $role->label = 'ModernTrade';
            $role->save();
        }
    }
}
