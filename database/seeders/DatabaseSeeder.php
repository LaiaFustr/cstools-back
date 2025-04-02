<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\DemurrageStorage;
use App\Models\Country;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(DemurrageStorageSeeder::class);
        //DemurrageStorage::factory()->count(50)->create();

        


        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        User::factory(10)->create();
        Country::factory()->count(200)->create();
    }
}
