<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat Permissions (Izin)
        Permission::firstOrCreate(['name' => 'view dashboard']);
        Permission::firstOrCreate(['name' => 'manage surveys']);
        Permission::firstOrCreate(['name' => 'upload survey data']);
        Permission::firstOrCreate(['name' => 'view reports']);
        Permission::firstOrCreate(['name' => 'manage users']);

        // Peran untuk Analyst
        $analystRole = Role::firstOrCreate(['name' => 'Analyst']);
        $analystRole->givePermissionTo([
            'view dashboard',
            'view reports',
        ]);

        // Peran untuk Enumerator
        $enumeratorRole = Role::firstOrCreate(['name' => 'Enumerator']);
        $enumeratorRole->givePermissionTo([
            'view dashboard',
            'upload survey data',
        ]);

        // Peran untuk Admin - mendapatkan semua izin
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $adminRole->givePermissionTo(Permission::all());
    }
}
