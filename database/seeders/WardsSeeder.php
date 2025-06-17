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
        $lga = LocalGovernment::where('title', 'Bakura')->where('state_id', $state->id)->first();

        if (!$state || !$lga) {
            $this->command->error('Zamfara state or Bakura LGA not found.');
            return;
        }

        $wards = [
            "BIRNIN TUDU",
            "DAMRI",
            "DANKADU",
            "DAN MANAU",
            "YAR KUFOJI",
            "DAKKO",
            "NASARAWA",
            "RINI",
            "YAR GEDA",
        ];

        foreach ($wards as $ward) {
            Ward::create([
                'title' => $ward,
                'state_id' => $state->id,
                'local_government_id' => $lga->id,
                'status' => 'active',
            ]);
        }

        $this->command->info('Wards for bakura LGA created successfully.');

    }
}
