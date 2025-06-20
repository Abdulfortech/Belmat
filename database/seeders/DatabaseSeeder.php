<?php

namespace Database\Seeders;

use App\Models\PollingUnit;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(StatesSeeder::class);
        $this->call(LGAsSeeder::class);
        $this->call(PoliticalPartiesSeeder::class);
        $this->call(ElectionTypesSeeder::class);
        $this->call(SenatorialZonesSeeder::class);
        $this->call(PoliticalZonesSeeder::class);
        $this->call(PollingUnitsSeeder::class);
        $this->call(ElectionSeeder::class);
    }
}
