<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmbargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       DB::table('embargos')->insert([
           'empaicod' => 'FR',
            'embobserv' => 'No business Allowed',
            'emexcl' => 'EXCL',
            'emusua' => '',
            'emfeca' => now(),
            'emusum' => '',
            'emfecm' => now(),
            'embaja' => ''
        ]);

    }
}
