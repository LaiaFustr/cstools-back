<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Country::class;

    public function definition(): array
    {
        $papaicod = $this->faker->unique()->regexify('[A-Z]{2,3}');
        $country = $this->faker->unique()->country();
        $paarecod = $this->faker->randomElement(['AFRICA', 'ASIA', 'ASIAOCC', 'AMENOR', 'AMECEN', 'AMESUR', ' EUROPE', 'PACIFI', 'POLSUR', 'CARIBE', 'PACSUR', 'ATLNOR', 'ATLSUR', 'OCEIND', 'OCEATL', 'OCEANT', 'UNKNOWN']);
        $paarees = '';

        switch ($paarecod) {

            case 'PACIFI':
                $paarees = $this->faker->randomElement(['OCEANIA', 'FAR EAST']);
                break;
            case 'OCEIND':
                $paarees = $this->faker->randomElement(['OCEANIA', 'LATAM', 'AFRICA', 'SUBCONTINENTE INDIO']);
                break;
            case 'OCEATL':
                $paarees = $this->faker->randomElement(['NORTH AMERICA', 'LATAM', 'AFRICA', 'NORTH EUROPE']);
                break;

            case 'PACSUR':
                $paarees = 'OCEANIA';
                break;
            case 'EUROPE':
                $paarees = $this->faker->randomElement(['MEDITERRANEAN', 'NORTH EUROPE']);
                break;

            case 'ATLNOR':
                $paarees = 'NORTH EUROPE';
                break;
            case 'AMENOR':
                $paarees =  $this->faker->randomElement(['NORTH AMERICA', 'LATAM']);
                break;
            case 'ASIAOCC':
                $paarees = $this->faker->randomElement(['SUBCONTINENTE INDIO', 'MEDITERRANEAN', 'MIDDLE EAST', 'NORTH EUROPE']);
                break;
            case 'ASIA':
                $paarees = $this->faker->randomElement(['SUBCONTINENTE INDIO', 'FAR EAST']);
                break;
            case 'AFRICA':
                $paarees = 'AFRICA';
                break;
            case 'OCEANT':
            case 'POLSUR':
            case 'CARIBE':
            case 'ATLSUR':
            case 'AMESUR':
            case 'AMECEN':
                $paarees = 'LATAM';
                break;
            case 'UNKNOWN':
            default:
                $paarees = 'DESCONOCIDA';
                break;
        }
        return [
            'papaicod' => $papaicod, //regexify
            'papainom' => $country,
            'papaibus' => strtoupper($country),
            'papainomp' => $country,
            'papaibusp' => strtoupper($country),
            'papainome' => $country,
            'papaibuse' => strtoupper($country),
            'papainomf' => $country,
            'papaibusf' => strtoupper($country),
            'paarecod' => $paarecod,
            'paarees' => $paarees,
            'papaidch' => $papaicod,
            'pafmtdch' => $this->faker->regexify('^A?9{3,5}(-9{3,5}){0,2}(A?)$'),
            'pacpcx' => $this->faker->randomElement(['S', 'N']),
            'pacee' => 'N',
            'padiv' => '',
            'paestprv' => $this->faker->randomElement(['S', '']),
            'pabaja' => ''

        ];
    }
}
