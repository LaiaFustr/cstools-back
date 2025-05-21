<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocalPortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('local_ports')->insert([
            [
                'plptoloc' => 'ESVLC',
                'plcodpos' => '46024',
                'plnompto' => 'VALENCIA',
                'pldlgni' => '231',
                'pldlgne' => '231',
                'plfecalt' => '2023-03-03',
                'plbaja' => '',
            ],
            [
                'plptoloc' => 'ESBCN',
                'plcodpos' => '08039',
                'plnompto' => 'BARCELONA',
                'pldlgni' => '234',
                'pldlgne' => '234',
                'plfecalt' => '2023-03-03',
                'plbaja' => '',
            ],
            [
                'plptoloc' => 'ESALG',
                'plcodpos' => '11201',
                'plnompto' => 'ALGECIRAS',
                'pldlgni' => '237',
                'pldlgne' => '237',
                'plfecalt' => '2023-01-01',
                'plbaja' => '',
            ],
            [
                'plptoloc' => 'ESVGO',
                'plcodpos' => '36207',
                'plnompto' => 'VIGO',
                'pldlgni' => '238',
                'pldlgne' => '238',
                'plfecalt' => '2023-03-07',
                'plbaja' => '',
            ],
            [
                'plptoloc' => 'ESBIO',
                'plcodpos' => '48980',
                'plnompto' => 'BILBAO',
                'pldlgni' => '239',
                'pldlgne' => '239',
                'plfecalt' => '2023-03-07',
                'plbaja' => '',
            ],
            [
                'plptoloc' => 'ESGIJ',
                'plcodpos' => '33212',
                'plnompto' => 'GIJON',
                'pldlgni' => '238',
                'pldlgne' => '238',
                'plfecalt' => '2023-03-07',
                'plbaja' => '',
            ],
            [],
            [],
            [],
            []
        ]);
    }
}
