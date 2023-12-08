<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'view php info', 'guard_name' => 'api']);
        Permission::create(['name' => 'view laravel logs', 'guard_name' => 'api']);
        Permission::create(['name' => 'view users', 'guard_name' => 'api']);
    }
}
