<?php

namespace Database\Seeders;

use App\Models\PoliticalZone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliticalZonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Political Zones (same structure, example data)
        $politicalZones = [
            ['title' => 'North West', 'code' => 'NW'],
            ['title' => 'North East', 'code' => 'NE'],
            ['title' => 'North Central', 'code' => 'NC'],
            ['title' => 'South West', 'code' => 'SW'],
            ['title' => 'South East', 'code' => 'SE'],
            ['title' => 'South South', 'code' => 'SS']
        ];

        foreach ($politicalZones as $zone) {
            PoliticalZone::create([
                'title' => $zone['title'],
                'code' => $zone['code'],
                'status' => 'active'
            ]);
        }
    }
}
