<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

use App\Models\Account\User;
use App\Models\Operation\Company;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        // implementasi seeder : Role adalah Case Sensitive, hati-hati saat pembuatan Role

        // // single user
        // $user = User::create([
        //     'name'      => 'Administrator',
        //     'email'     => 'admin@gmail.com',
        //     'password'  => bcrypt('admin'),
        //     'status_account' => 'active',
        // ]);
        // $permissions = Permission::all();
        // $role = Role::find(1);
        // $role->syncPermissions($permissions);
        // $user->assignRole($role);

        // multiple user
        $roles = [
            'Administrator' => Role::findOrCreate('Administrator'),
            'Management' => Role::findOrCreate('Management'),
            'User' => Role::findOrCreate('User'),
        ];

        $rolePermissions = [
            'Administrator' => [
                'dashboard.index',
                'help.index',
                'permissions.index',
                'profiles.role', 'profiles.company',
                'users.index', 'users.create', 'users.edit', 'users.delete',
                'roles.index', 'roles.create', 'roles.edit', 'roles.delete',
                'clients.index', 'clients.create', 'clients.edit', 'clients.delete',
                'companies.index', 'companies.create', 'companies.edit', 'companies.delete',

                // 'payment-terms.index',
                // 'account-groups.index',
                // 'withholding-taxes.index',
                // 'incoterms.index',
                // 'planning-groups.index',
                // 'reconciliations.index',

                // 'vendor-requests.index', 'vendor-requests.create', 'vendor-requests.edit', 'vendor-requests.delete',
                // 'vendor-requests.info_companies.index', 'vendor-requests.info_companies.create', 'vendor-requests.info_companies.edit',
                // 'vendor-requests.info_finances.index', 'vendor-requests.info_finances.create', 'vendor-requests.info_finances.edit',
                // 'vendor-requests.info_legals.index', 'vendor-requests.info_legals.create', 'vendor-requests.info_legals.edit',
            ],
            'Management' => [
                'dashboard.index',
                'help.index',
                'profiles.role', 'profiles.company',
                'users.index',
                'roles.index',
                'clients.index',
                'companies.index',
            ],
            'User' => [
                'dashboard.index',
                'help.index',
            ],
        ];

        foreach ($roles as $roleName => $role) {
            $role->syncPermissions($rolePermissions[$roleName]);
        }

        $usersData = [
            [
                'name' => 'Administrator',
                'email' => 'administrator@gmail.com',
                'password' => bcrypt('administrator'),
                'status_account' => 'active',
                'roles' => ['Administrator'],
                'companies' => ['M01', 'C01', 'F01'],
            ],
            [
                'name' => 'Manager',
                'email' => 'manager@gmail.com',
                'password' => bcrypt('manager'),
                'status_account' => 'inactive',
                'roles' => ['Management'],
                'companies' => ['M01'],
            ],
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => bcrypt('user'),
                'status_account' => 'inactive',
                'roles' => ['User'],
                'companies' => ['M01'],
            ],
        ];

        // get usersData company codes
        $companyCodes = collect($usersData)->pluck('companies')->flatten()->unique()->toArray();
        $companies = Company::whereIn('company_code', $companyCodes)->get()->keyBy('company_code');

        // init user
        foreach ($usersData as $userData) {
            
            // user
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
                'status_account' => $userData['status_account'],
            ]);
        
            // role
            foreach ($userData['roles'] as $roleName) {
                $role = $roles[$roleName];
                $user->assignRole($role);
            }
        
            // company
            $companyId = [];
            foreach ($userData['companies'] as $companyCode) {
                if (isset($companies[$companyCode])) {
                    $companyId[] = $companies[$companyCode]->id;
                }
            }

            // user has companies (pivot)
            $pivotData = [];
            foreach ($companyId as $companyId) {
                $pivotData[$companyId] = ['id' => (string) Str::uuid()]; 
            }
            $user->companies()->attach($pivotData);
        }        
    }
}
