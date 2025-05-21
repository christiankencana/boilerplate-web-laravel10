<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // sesuaikan juga dengan UserTableSeeder.php
        // implementasi seeder : Role adalah Case Sensitive, hati-hati saat pembuatan Role

        Role::create(['name' => 'Administrator']);
        Role::create(['name' => 'Management']);
        Role::create(['name' => 'User']);
    }
}
