<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DemurrageStorage;
use Carbon\Carbon;

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
            'valid' => Carbon::parse($this->faker->dateTimeBetween('-10 years', '2024-12-31'))->format('Y-m-d'),
            'tarsup' => $this->faker->randomFloat(2, 0, 99),
        ];
       
    }
}
