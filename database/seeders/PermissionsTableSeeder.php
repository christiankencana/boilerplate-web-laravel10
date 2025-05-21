<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //permission dashboard, help
        Permission::create(['name' => 'dashboard.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'help.index', 'guard_name' => 'web']);

        //permission permissions
        Permission::create(['name' => 'permissions.index', 'guard_name' => 'web']);

        //permission roles
        Permission::create(['name' => 'roles.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.delete', 'guard_name' => 'web']);

        //permission users
        Permission::create(['name' => 'users.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.delete', 'guard_name' => 'web']);

        //permission profiles
        Permission::create(['name' => 'profiles.role', 'guard_name' => 'web']);
        Permission::create(['name' => 'profiles.company', 'guard_name' => 'web']);

        //permission info_companies
        Permission::create(['name' => 'companies.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'companies.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'companies.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'companies.delete', 'guard_name' => 'web']);
        // Permission::create(['name' => 'info_companies.show', 'guard_name' => 'web']);

        //permission clients
        Permission::create(['name' => 'clients.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'clients.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'clients.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'clients.delete', 'guard_name' => 'web']);
        // Permission::create(['name' => 'clients.show', 'guard_name' => 'web']);

        //permission operations
        // Permission::create(['name' => 'payment-terms.index', 'guard_name' => 'web']);
        // Permission::create(['name' => 'account-groups.index', 'guard_name' => 'web']);
        // Permission::create(['name' => 'withholding-taxes.index', 'guard_name' => 'web']);
        // Permission::create(['name' => 'incoterms.index', 'guard_name' => 'web']);
        // Permission::create(['name' => 'planning-groups.index', 'guard_name' => 'web']);
        // Permission::create(['name' => 'reconciliations.index', 'guard_name' => 'web']);

        //permission transactions
        // Permission::create(['name' => 'vendor-requests.index', 'guard_name' => 'web']);
        // Permission::create(['name' => 'vendor-requests.create', 'guard_name' => 'web']);
        // Permission::create(['name' => 'vendor-requests.edit', 'guard_name' => 'web']);
        // Permission::create(['name' => 'vendor-requests.delete', 'guard_name' => 'web']);

        // Permission::create(['name' => 'vendor-requests.info_companies.index', 'guard_name' => 'web']);
        // Permission::create(['name' => 'vendor-requests.info_companies.create', 'guard_name' => 'web']);
        // Permission::create(['name' => 'vendor-requests.info_companies.edit', 'guard_name' => 'web']);

        // Permission::create(['name' => 'vendor-requests.info_finances.index', 'guard_name' => 'web']);
        // Permission::create(['name' => 'vendor-requests.info_finances.create', 'guard_name' => 'web']);
        // Permission::create(['name' => 'vendor-requests.info_finances.edit', 'guard_name' => 'web']);

        // Permission::create(['name' => 'vendor-requests.info_legals.index', 'guard_name' => 'web']);
        // Permission::create(['name' => 'vendor-requests.info_legals.create', 'guard_name' => 'web']);
        // Permission::create(['name' => 'vendor-requests.info_legals.edit', 'guard_name' => 'web']);

    }
}
