<?php

namespace Database\Factories;

use App\Models\Postalcode;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Postalcode>
 */
class PostalcodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        /* $cps = Postalcode::pluck('cpcouid'); */
        $city= $this->faker->city();
        $num = $this->faker->randomNumber(6, true);
        
        return [
            'cpcouid' => $this->faker->randomElement(Country::all()->pluck('papaicod')),
            'cptownm' => $city,
            'cptownmori' => $city,
            'cpstrpcori' =>$num,
            'cpendpcori'=>$num,
            'cpstrpc'=>$num,
            'cpendpc'=>$num,
            'cpprvid' =>$this->faker->randomElement([$this->faker->randomNumber(3, true), $this->faker->unique()->regexify('[A-Z]{2,3}'),'']),
            'cpprvcod'=>$this->faker->randomElement([$this->faker->randomNumber(3, true), $this->faker->unique()->regexify('[A-Z]{2,3}'),'']),
            'cpprvnom'=>$this->faker->unique()->city(),
            'cptownpcode'=>$this->faker->randomElement([$this->faker->randomNumber(5, true),'']),
            'cptownplace'=>$this->faker->randomElement(['Y','N']),
            
            'cpaliasin'=>$this->faker->randomElement(['Y','N']),
            
            'cpbaja'=>$this->faker->randomElement(['','S']),
        ];
    }
}
