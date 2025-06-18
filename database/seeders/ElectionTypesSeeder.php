<?php

namespace Database\Seeders;

use App\Models\ElectionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ElectionTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Election Types
        $electionTypes = [
            'Presidential',
            'Gubernatorial',
            'Senatorial',
            'House of Representatives',
            'State House of Assembly',
            'Local Government Chairmanship',
            'Local Government Councillorship'
        ];

        foreach ($electionTypes as $type) {
            ElectionType::create([
                'title' => $type,
                'status' => 'active'
            ]);
        }

    }
}
