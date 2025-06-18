<?php

namespace Database\Seeders;

use App\Models\LocalGovernment;
use App\Models\State;
use App\Models\Ward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WardsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the state and LGA IDs
        $state = State::where('title', 'Zamfara')->first();
        $lga = LocalGovernment::where('title', 'Zurmi')->where('state_id', $state->id)->first();

        if (!$state || !$lga) {
            $this->command->error('Zamfara state or Zurmi LGA not found.');
            return;
        }

        $wards = [
            "BOKO",
            "DAURAN / BIRNIN-TSABA",
            "DOLE",
            "GALADIMA/YANRUWA",
            "KANWA",
            "KWASHBAWA",
            "MASHEM",
            "KUTURU/MAYASA",
            "RUKUDAWA",
            "YAN BUKI/ DUTSI",
            "ZURMI"
        ];

        foreach ($wards as $ward) {
            Ward::create([
                'title' => $ward,
                'state_id' => $state->id,
                'local_government_id' => $lga->id,
                'status' => 'active',
            ]);
        }

        $this->command->info('Wards for Zurmi LGA created successfully.');

    }
}
