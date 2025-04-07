<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LocalPort>
 */
class LocalPortFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $faker = \Faker\Factory::class;


        $fakeC = $this->faker->randomElement([
            'ES',
            'PT'
        ]);

        $fakeCity = '';
        if ($fakeC == 'ES') {
            $faker = \Faker\Factory::create('es_ES');
        } else {
            $faker = \Faker\Factory::create('pt_PT');
        }
        $fakeCity = $faker->unique()->city();
        $subtrCity = $this->faker->randomLetter().substr($fakeCity, 2, 5);


        $codCity = str_replace([' ', "'", '?',  'á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú'], '', $subtrCity);

        return [
            'plptoloc' => mb_strtoupper($fakeC . $codCity),
            'plcodpos' => $this->faker->postcode(),
            'plnompto' => $fakeCity,
            'pldlgni' => $this->faker->randomNumber(3, true),
            'pldlgne' => $this->faker->randomNumber(3, true),
            'plfecalt' => $this->faker->date(),
            'plbaja' => '',
        ];
    }
}
