<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Country;
use App\Models\Embargo;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Embargo>
 */
class EmbargoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition(): array
    {

        $embargos = Embargo::pluck('empaicod');

        $emexcl = $this->faker->randomElement(['EXCL', 'HIGH', 'MIDD', 'RISK']);
        switch ($emexcl) {
            case 'EXCL':
                $emobserv = 'No business Allowed';
                break;
            case 'HIGH':
                $emobserv = 'High Risk Country';
                break;
            case 'MIDD':
                $emobserv = 'Middle Risk Country';
                break;
            case 'RISK':
                $emobserv = 'Risk Country';
                break;
        }

        return [
            'empaicod' => $this->faker->unique()->randomElement(Country::whereNotIn('papaicod', $embargos)->pluck('papaicod')),
            'embobserv' => $emobserv,
            'emexcl' => $emexcl,
            'emusua' => '',
            'emfeca' => now(),
            'emusum' => '',
            'emfecm' => now(),
            'embaja' => ''

        ];
    }
}
