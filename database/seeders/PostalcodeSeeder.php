<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Postalcode;

class PostalcodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


   Postalcode::factory()->count(3000)->create();

       /*  DB::table('postalcodes')->insert([
            [
            ]
        ]); */
    }
}
