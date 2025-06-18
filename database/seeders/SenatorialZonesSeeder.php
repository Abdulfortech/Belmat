<?php

namespace Database\Seeders;

use App\Models\SenatorialZone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SenatorialZonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Seed Senatorial Zones (example zones, adjust as needed)
        $senatorialZones = [
            ['title' => 'North West', 'code' => 'NW'],
            ['title' => 'North East', 'code' => 'NE'],
            ['title' => 'North Central', 'code' => 'NC'],
            ['title' => 'South West', 'code' => 'SW'],
            ['title' => 'South East', 'code' => 'SE'],
            ['title' => 'South South', 'code' => 'SS']
        ];

        foreach ($senatorialZones as $zone) {
            SenatorialZone::create([
                'title' => $zone['title'],
                'code' => $zone['code'],
                'status' => 'active'
            ]);
        }

    }
}
