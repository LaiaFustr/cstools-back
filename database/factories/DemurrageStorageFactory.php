<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DemurrageStorage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DemurrageStorage>
 */
class DemurrageStorageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = DemurrageStorage::class;

    public function definition(): array
    {
        return [
            'carrier' => $this->faker->randomElement(['ARKAS', 'CMA', 'COSCO SHIPPING', 'EVERGREEN', 'HAMBURG SUD', 'HAPAG', 'HYUNDAI', 'KALYPSO', 'MAERSK', 'MAERSK SPOT', 'MSC', 'ONE', 'OOCL', 'SEALAND', 'YANG MING', 'ZIM']
        ),
            'type' => $this->faker->randomElement(['DEM', 'STO']),
            'port' => $this->faker->randomElement([
                'ALGECIRAS', 'ALICANTE', 'ALMERIA', 'BARCELONA', 'BILBAO', 'CADIZ', 'CARTAGENA', 'CASTELLON', 
                'GIJON', 'LAS PALMAS', 'MALAGA', 'MARIN', 'SAGUNTO', 'TARRAGONA', 'TENERIFE', 'VALENCIA', 'VIGO'
            ]),
            'fromday' => $this->faker->randomNumber(2),
            'today' => $this->faker->randomNumber(2),
            'tar20' => $this->faker->randomFloat(2, 0, 16),
            'tar40' => $this->faker->randomFloat(2, 0, 99),
            'valid' => $this->faker->date(),
            'tarsup' => $this->faker->randomFloat(2, 0, 99),
        ];

        /* seeder:
        
        
        DB::table('demurrage_storages')->insert(
            [
                'carrier' => 'CMA',
                'type' => 'D',
                'port' => 'BARCELONA',
                'fromday' => 0,
                'today' => 10,
                'tar20' => 10.00,
                'tar40' => 20.00,
                'valid' => '2025-03-24',
                'tarsup' => 5.00,
            ],
            [
                'carrier' => 'ARKAS',
                'type' => 'S',
                'port' => 'ALGECIRAS',
                'fromday' => 0,
                'today' => 7,
                'tar20' => 11.00,
                'tar40' => 22.00,
                'valid' => '2025-03-25',
                'tarsup' => 3.00
            ],
            [
                'carrier' => 'CMA',
                'type' => 'D',
                'port' => 'BILBAO',
                'fromday' => 0,
                'today' => 10,
                'tar20' => 10.00,
                'tar40' => 20.00,
                'valid' => '2025-04-24',
                'tarsup' => 5.00
            ],
            [
                'carrier' => 'ARKAS',
                'type' => 'S',
                'port' => 'ALGECIRAS',
                'fromday' => 0,
                'today' => 7,
                'tar20' => 11.00,
                'tar40' => 22.00,
                'valid' => '2025-04-25',
                'tarsup' => 3.00
            ],
            [
                'carrier' => 'ARKAS',
                'type' => 'D',
                'port' => 'BARCELONA',
                'fromday' => 0,
                'today' => 10,
                'tar20' => 10.00,
                'tar40' => 20.00,
                'valid' => '2025-05-24',
                'tarsup' => 5.00
            ],
            [
                'carrier' => 'EVERGREEN',
                'type' => 'S',
                'port' => 'BILBAO',
                'fromday' => 0,
                'today' => 7,
                'tar20' => 11.00,
                'tar40' => 22.00,
                'valid' => '2025-05-25',
                'tarsup' => 3.00
            ],
            [
                'carrier' => 'EVERGREEN',
                'type' => 'D',
                'port' => 'VALENCIA',
                'fromday' => 0,
                'today' => 10,
                'tar20' => 10.00,
                'tar40' => 20.00,
                'valid' => '2025-06-24',
                'tarsup' => 5.00
            ]
        );*/
    }
}
