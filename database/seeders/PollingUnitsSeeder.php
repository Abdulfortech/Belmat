<?php

namespace Database\Seeders;

use App\Models\LocalGovernment;
use App\Models\PollingUnit;
use App\Models\State;
use App\Models\Ward;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PollingUnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the state and LGA IDs
        $state = State::where('title', 'Zamfara')->first();
        $lga = LocalGovernment::where('title', 'Anka')->where('state_id', $state->id)->first();
        $ward = Ward::where('title', 'Bagega')->where('local_government_id', $lga->id)->first();

        if (!$state || !$lga  || !$ward) {
            $this->command->error('Zamfara state or Zurmi LGA not found.');
            return;
        }

        $units = [
            ["title" => "SHIYAR ARDO/ AREA COURT", "code"=> "36/03/01/005"],
            ["title" => "SABUWAR KUYA/LIMANTAWA PRI. SCHOOL", "code"=> "36/03/01/013"],
            ["title" => "SHIYAR ZARUMAI I./ LIBRARY", "code"=> "36/03/01/011"],
            ["title" => "TSAMIYAR TANKO/ISLAMIYYA", "code"=> "36/03/01/023"],
            ["title" => "SHIYAR LIMAN III/GIDAN GONA", "code"=> "36/03/01/019"],
            ["title" => "ZARUMAI V/ GSS BIRNIN MAGAJI BLOCK E", "code"=> "36/03/01/026"],
        ];

        foreach ($units as $unit) {
            PollingUnit::create([
                'title' => $unit['title'],
                'code' => $unit['code'],
                'ward_id' => $ward->id,
                'state_id' => $state->id,
                'local_government_id' => $lga->id,
                'status' => 'Active',
            ]);
        }

        $this->command->info('Wards for Zurmi LGA created successfully.');

    }
}
