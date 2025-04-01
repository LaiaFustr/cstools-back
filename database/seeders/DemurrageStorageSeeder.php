<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DemurrageStorageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('demurrage_storages')->insert([
            [
                'carrier' => 'CMA',
                'type' => 'DEM',
                'port' => 'VALENCIA',
                'fromday' => 0,
                'today' => 7,
                'tar20' => 0,
                'tar40' => 0,
                'valid' => '2025-01-15',
                'tarsup' =>0,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'carrier' => 'CMA',
                'type' => 'DEM',
                'port' => 'VALENCIA',
                'fromday' => 8,
                'today' => 11,
                'tar20' => 37,
                'tar40' => 52,
                'valid' => '2025-01-15',
                'tarsup' =>0,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'carrier' => 'CMA',
                'type' => 'DEM',
                'port' => 'VALENCIA',
                'fromday' => 12,
                'today' => 17,
                'tar20' => 52,
                'tar40' => 77,
                'valid' => '2025-01-15',
                'tarsup' =>0,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'carrier' => 'CMA',
                'type' => 'DEM',
                'port' => 'VALENCIA',
                'fromday' => 18,
                'today' => 999,
                'tar20' => 75,
                'tar40' => 105,
                'valid' => '2025-01-15',
                'tarsup' =>20,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            
            
            
            
            
            
            
            [
                'carrier' => 'CMA',
                'type' => 'STO',
                'port' => 'VALENCIA',
                'fromday' => 0,
                'today' => 5,
                'tar20' => 0,
                'tar40' => 0,
                'valid' => '2024-02-01',
                'tarsup' =>0,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'carrier' => 'CMA',
                'type' => 'STO',
                'port' => 'VALENCIA',
                'fromday' => 6,
                'today' => 7,
                'tar20' => 2,
                'tar40' => 4,
                'valid' => '2024-02-01',
                'tarsup' => 0,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
             [
                'carrier' => 'CMA',
                'type' => 'STO',
                'port' => 'VALENCIA',
                'fromday' => 8,
                'today' => 14,
                'tar20' => 5,
                'tar40' => 10,
                'valid' => '2024-02-01',
                'tarsup' => 0,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'carrier' => 'CMA',
                'type' => 'STO',
                'port' => 'VALENCIA',
                'fromday' => 15,
                'today' => 999,
                'tar20' => 40,
                'tar40' => 80,
                'valid' => '2024-02-01',
                'tarsup' =>10,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'carrier' => 'CMA',
                'type' => 'STO',
                'port' => 'VALENCIA',
                'fromday' => 0,
                'today' => 4,
                'tar20' => 0,
                'tar40' => 0,
                'valid' => '2019-01-01',
                'tarsup' =>0,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'carrier' => 'CMA',
                'type' => 'STO',
                'port' => 'VALENCIA',
                'fromday' => 5,
                'today' => 7,
                'tar20' => 1.57,
                'tar40' => 3.14,
                'valid' => '2019-01-01',
                'tarsup' =>6,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'carrier' => 'CMA',
                'type' => 'STO',
                'port' => 'VALENCIA',
                'fromday' => 8,
                'today' => 18,
                'tar20' => 3.14,
                'tar40' => 6.28,
                'valid' => '2019-01-01',
                'tarsup' =>10,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'carrier' => 'CMA',
                'type' => 'STO',
                'port' => 'VALENCIA',
                'fromday' => 19,
                'today' => 30,
                'tar20' => 10,
                'tar40' => 20,
                'valid' => '2019-01-01',
                'tarsup' =>15,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'carrier' => 'CMA',
                'type' => 'STO',
                'port' => 'VALENCIA',
                'fromday' => 31,
                'today' => 999,
                'tar20' => 30,
                'tar40' => 60,
                'valid' => '2019-01-01',
                'tarsup' =>20,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
           
            [
                'carrier' => 'ARKAS',
                'type' => 'DEM',
                'port' => 'ALGECIRAS',
                'fromday' => 22,
                'today' => 999,
                'tar20' => 70.00,
                'tar40' => 100.00,
                'valid' => '2017-04-22',
                'tarsup' => 0.00,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
             [
                'carrier' => 'ARKAS',
                'type' => 'STO',
                'port' => 'ALGECIRAS',
                'fromday' => 0,
                'today' => 7,
                'tar20' => 11.00,
                'tar40' => 22.00,
                'valid' => '2017-04-20',
                'tarsup' => 0.00,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
             [
                'carrier' => 'ARKAS',
                'type' => 'STO',
                'port' => 'ALGECIRAS',
                'fromday' => 8,
                'today' => 12,
                'tar20' => 50.00,
                'tar40' => 75.00,
                'valid' => '2018-04-25',
                'tarsup' => 0.00,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
             [
                'carrier' => 'ARKAS',
                'type' => 'STO',
                'port' => 'ALGECIRAS',
                'fromday' => 13,
                'today' => 999,
                'tar20' => 75.00,
                'tar40' => 90.00,
                'valid' => '2022-04-21',
                'tarsup' => 0.00,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'carrier' => 'ARKAS',
                'type' => 'DEM',
                'port' => 'BARCELONA',
                'fromday' => 0,
                'today' => 10,
                'tar20' => 10.00,
                'tar40' => 20.00,
                'valid' => '2019-05-27',
                'tarsup' => 5.00,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'carrier' => 'EVERGREEN',
                'type' => 'STO',
                'port' => 'BILBAO',
                'fromday' => 0,
                'today' => 7,
                'tar20' => 11.00,
                'tar40' => 22.00,
                'valid' => '2021-05-02',
                'tarsup' => 3.00,
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'carrier' => 'EVERGREEN',
                'type' => 'DEM',
                'port' => 'VALENCIA',
                'fromday' => 0,
                'today' => 10,
                'tar20' => 10.00,
                'tar40' => 20.00,
                'valid' => '2020-06-12',
                'tarsup' => 5.00,
                'created_at'=>now(),
                'updated_at'=>now()
            ]

        ]);
    }
}
