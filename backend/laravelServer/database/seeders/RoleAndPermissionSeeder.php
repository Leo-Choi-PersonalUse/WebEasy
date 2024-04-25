<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $permissions = [
            'create-users',
            'edit-users',
            'delete-users',

            'create-roles',
            'edit-roles',
            'delete-roles',

            'create-permissions',
            'edit-permissions',
            'delete-permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roleAdmin = Role::create([
            'name'=> 'admin',
        ]);

        $roleAdmin->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
            'create-roles',
            'edit-roles',
            'delete-roles',
            'create-permissions',
            'edit-permissions',
            'delete-permissions',
        ]);
    }
}