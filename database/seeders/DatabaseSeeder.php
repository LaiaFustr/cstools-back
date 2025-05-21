<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\DemurrageStorage;
use App\Models\Country;
use App\Models\Embargo;
use App\Models\LocalPort;
use App\Models\Postalcode;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CountrySeeder::class);
        $this->call(DemurrageStorageSeeder::class);
        //DemurrageStorage::factory()->count(50)->create();

        $this->call(DistanceSeeder::class);


        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        User::factory(10)->create();


        /*  Country::factory()->count(200)->create(); */
        Embargo::factory()->count(1)->create();

        /* LocalPort::factory()->count(30)->create(); */
        $this->call(LocalPortSeeder::class);
        /* Postalcode::factory()->count(3000)->create(); */

        /* Country::factory()->count(200)->create(); */
        /* Embargo::factory()->count(30)->create(); */

        

  

    }
}
