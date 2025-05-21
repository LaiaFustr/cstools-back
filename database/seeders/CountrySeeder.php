<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use Illuminate\Support\Facades\DB;


class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->insert([
            [
                'papaicod' => 'ES',
                'papainom' => 'España',
                'papaibus' => 'ESPAÑA',
                'papainomp' => 'Espanha',
                'papaibusp' => strtoupper('Espanha'),
                'papainome' => 'Spain',
                'papaibuse' => strtoupper('Spain'),
                'papainomf' => 'Espagne',
                'papaibusf' => strtoupper('Espagne'),
                'paarecod' => 'EUROPA',
                'paarees' => 'MEDITERRANEAN',
                'papaidch' => 'E',
                'pafmtdch' => '99999',
                'pacpcx' => 'S',
                'pacee' => 'S',
                'padiv' => '',
                'paestprv' => '',
                'pabaja' => ''
            ],
            [
                'papaicod' => 'PT',
                'papainom' => 'Portugal',
                'papaibus' => strtoupper('Portugal'),
                'papainomp' => 'Portugal',
                'papaibusp' => strtoupper('Portugal'),
                'papainome' => 'Portugal',
                'papaibuse' => strtoupper('Portugal'),
                'papainomf' => 'Portugal',
                'papaibusf' => strtoupper('Portugal'),
                'paarecod' => 'EUROPA',
                'paarees' => 'NORTH EUROPE',
                'papaidch' => 'P',
                'pafmtdch' => '9999-999',
                'pacpcx' => 'S',
                'pacee' => 'S',
                'padiv' => '',
                'paestprv' => '',
                'pabaja' => ''
            ],
            [
                'papaicod' => 'FR',
                'papainom' => 'Francia',
                'papaibus' => strtoupper('Francia'),
                'papainomp' => 'França',
                'papaibusp' => strtoupper('França'),
                'papainome' => 'France',
                'papaibuse' => strtoupper('France'),
                'papainomf' => 'France',
                'papaibusf' => strtoupper('France'),
                'paarecod' => 'EUROPA',
                'paarees' => 'NORTH EUROPE',
                'papaidch' => 'F',
                'pafmtdch' => '99999',
                'pacpcx' => 'S',
                'pacee' => 'S',
                'padiv' => '',
                'paestprv' => '',
                'pabaja' => ''
            ],
            [
                'papaicod' => 'IT',
                'papainom' => 'Italia',
                'papaibus' => strtoupper('Italia'),
                'papainomp' => 'Itália',
                'papaibusp' => strtoupper('Itália'),
                'papainome' => 'Italy',
                'papaibuse' => strtoupper('Italy'),
                'papainomf' => 'Italie',
                'papaibusf' => strtoupper('Italie'),
                'paarecod' => 'EUROPA',
                'paarees' => 'MEDITERRANEAN',
                'papaidch' => 'I',
                'pafmtdch' => '99999',
                'pacpcx' => 'S',
                'pacee' => 'S',
                'padiv' => '',
                'paestprv' => '',
                'pabaja' => ''
            ],
            [
                'papaicod' => 'DE',
                'papainom' => 'Alemania',
                'papaibus' => strtoupper('Alemania'),
                'papainomp' => 'Alemanha',
                'papaibusp' => strtoupper('Alemanha'),
                'papainome' => 'Germany',
                'papaibuse' => strtoupper('Germany'),
                'papainomf' => 'Allemagne',
                'papaibusf' => strtoupper('Allemagne'),
                'paarecod' => 'EUROPA',
                'paarees' => 'NORTH EUROPE',
                'papaidch' => 'D',
                'pafmtdch' => '99999',
                'pacpcx' => 'S',
                'pacee' => 'S',
                'padiv' => '',
                'paestprv' => '',
                'pabaja' => ''
            ],
           /*  [
           'papaicod' => '',
                'papainom' => '',
                'papaibus' => strtoupper(''),
                'papainomp' => '',
                'papaibusp' => strtoupper(''),
                'papainome' => '',
                'papaibuse' => strtoupper(''),
                'papainomf' => '',
                'papaibusf' => strtoupper(''),
                'paarecod' => 'EUROPA',
                'paarees' => '',
                'papaidch' => 'D',
                'pafmtdch' => '99999',
                'pacpcx' => 'S',
                'pacee' => 'S',
                'padiv' => '',
                'paestprv' => '',
                'pabaja' => ''
           ],
            [],
            [],
            [],
            [],
            [],
            [],
            [] */
        ]);
    }
}
