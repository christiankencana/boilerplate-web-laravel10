<?php

namespace Database\Seeders\Operation;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Operation\Client;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client::create([
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'client_code' => '388',
            'client_name' => 'AMG',
        ]);
        Client::create([
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'client_code' => '888',
            'client_name' => 'AMT',
        ]);
    }
}
