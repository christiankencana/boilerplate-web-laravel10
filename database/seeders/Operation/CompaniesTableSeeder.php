<?php

namespace Database\Seeders\Operation;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Operation\Client;
use App\Models\Operation\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client1 = Client::where('client_code', '388')->first();
        $client2 = Client::where('client_code', '888')->first();

        // Client 1 - 388 - AMG
        Company::create([
            'client_id'                 => $client1->id,
            'company_code'              => 'C01',
            'company_main_name'         => 'PT Fumira',
            'company_alternative_name'  => 'FMR',
        ]);
        Company::create([
            'client_id'                 => $client1->id,
            'company_code'              => 'C02',
            'company_main_name'         => 'PT Mega Investama Sejahtera',
            'company_alternative_name'  => 'MIS',
        ]);
        Company::create([
            'client_id'                 => $client1->id,
            'company_code'              => 'D01',
            'company_main_name'         => 'PT Peternakan Ayam Manggis',
            'company_alternative_name'  => 'PAM',
        ]);
        Company::create([
            'client_id'                 => $client1->id,
            'company_code'              => 'D02',
            'company_main_name'         => 'PT Hybro Indonesia',
            'company_alternative_name'  => 'HI',
        ]);
        Company::create([
            'client_id'                 => $client1->id,
            'company_code'              => 'D03',
            'company_main_name'         => 'PT Peternakan Ayam Gunung Sari',
            'company_alternative_name'  => 'PAGS',
        ]);
        Company::create([
            'client_id'                 => $client1->id,
            'company_code'              => 'D05',
            'company_main_name'         => 'PT Argo Makmur Proteindo',
            'company_alternative_name'  => 'AMP',
        ]);
        Company::create([
            'client_id'                 => $client1->id,
            'company_code'              => 'E01',
            'company_main_name'         => 'PT Megah Prayasa Sentosa',
            'company_alternative_name'  => 'MPS',
        ]);
        Company::create([
            'client_id'                 => $client1->id,
            'company_code'              => 'E02',
            'company_main_name'         => 'PT Citra Ina Feedmill',
            'company_alternative_name'  => 'CIF',
        ]);
        Company::create([
            'client_id'                 => $client1->id,
            'company_code'              => 'F01',
            'company_main_name'         => 'PT Kapuas Bara Utama',
            'company_alternative_name'  => 'KBU',
        ]);
        Company::create([
            'client_id'                 => $client1->id,
            'company_code'              => 'KW01',
            'company_main_name'         => 'Country Template KW',
            'company_alternative_name'  => 'CT',
        ]);
        Company::create([
            'client_id'                 => $client1->id,
            'company_code'              => 'M01',
            'company_main_name'         => 'PT Argo Manunggal Triasta',
            'company_alternative_name'  => 'AMT',
        ]);
        Company::create([
            'client_id'                 => $client1->id,
            'company_code'              => 'MCA',
            'company_main_name'         => 'MCA Bank',
            'company_alternative_name'  => 'MCA',
        ]);
        Company::create([
            'client_id'                 => $client1->id,
            'company_code'              => 'SLE0',
            'company_main_name'         => 'Musterbank',
            'company_alternative_name'  => 'MB',
        ]);

        // Client 2 - 888 - AMT
        Company::create([
            'client_id'                 => $client2->id,
            'company_code'              => 'B01',
            'company_main_name'         => 'PT ARGO MANUNGGAL TRIASTA',
            'company_alternative_name'  => 'MB',
        ]);
        Company::create([
            'client_id'                 => $client2->id,
            'company_code'              => 'C01',
            'company_main_name'         => 'PT Fumira',
            'company_alternative_name'  => 'FMR',
        ]);
        Company::create([
            'client_id'                 => $client2->id,
            'company_code'              => 'D01',
            'company_main_name'         => 'PT Peternakan Ayam Manggis',
            'company_alternative_name'  => 'PAM',
        ]);
        Company::create([
            'client_id'                 => $client2->id,
            'company_code'              => 'D02',
            'company_main_name'         => 'PT Hybro Indonesia',
            'company_alternative_name'  => 'HI',
        ]);
        Company::create([
            'client_id'                 => $client2->id,
            'company_code'              => 'D03',
            'company_main_name'         => 'PT Peternakan Ayam Gunung Sari',
            'company_alternative_name'  => 'PAGS',
        ]);
        Company::create([
            'client_id'                 => $client2->id,
            'company_code'              => 'E01',
            'company_main_name'         => 'PT Megah Prayasa Sentosa',
            'company_alternative_name'  => 'MPS',
        ]);
        Company::create([
            'client_id'                 => $client2->id,
            'company_code'              => 'E02',
            'company_main_name'         => 'PT Citra Ina Feedmill',
            'company_alternative_name'  => 'CIF',
        ]);
        Company::create([
            'client_id'                 => $client2->id,
            'company_code'              => 'KW01',
            'company_main_name'         => 'Country Template KW',
            'company_alternative_name'  => 'CT',
        ]);
        Company::create([
            'client_id'                 => $client2->id,
            'company_code'              => 'MCA',
            'company_main_name'         => 'MCA Bank',
            'company_alternative_name'  => 'MCA',
        ]);
        Company::create([
            'client_id'                 => $client2->id,
            'company_code'              => 'SLE0',
            'company_main_name'         => 'Musterbank',
            'company_alternative_name'  => 'MB',
        ]);
    }
}
