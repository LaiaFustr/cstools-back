<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostalcodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('postalcodes')->insert([
            [
              'cpcouid' => $this->faker->randomElement(Country::all()->pluck('papaicod')),
            'cptownm' => $city,
            'cptownmori' => $city,
            'cpstrpcori' =>$num,
            'cpendpcori'=>$num,
            'cpstrpc'=>$num,
            'cpendpc'=>$num,
            'cpprvid' =>$cod,
            'cpprvcod'=>$cod,
            'cpprvnom'=>mb_strtoupper($this->faker->state),
            'cptownpcode'=>$this->faker->randomElement([$this->faker->randomNumber(5, true),'']),
            'cptownplace'=>$this->faker->randomElement(['Y','N']),
            'cpaliasin'=>$this->faker->randomElement(['Y','N']),
            'cpbaja'=>$this->faker->randomElement(['','S']),  
            ],
            [],
            [],
            [],
            [],
            [],
            [],
            [],
            [],
            [],
        ]);
    }
}
