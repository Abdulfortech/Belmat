<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PoliticalPartiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parties = [
            ['title' => 'Accord', 'abbr' => 'A'],
            ['title' => 'Action Alliance', 'abbr' => 'AA'],
            ['title' => 'African Action Congress', 'abbr' => 'AAC'],
            ['title' => 'African Democratic Congress', 'abbr' => 'ADC'],
            ['title' => 'Action Democratic Party', 'abbr' => 'ADP'],
            ['title' => 'All Progressives Congress', 'abbr' => 'APC'],
            ['title' => 'All Progressives Grand Alliance', 'abbr' => 'APGA'],
            ['title' => 'Allied Peoples Movement', 'abbr' => 'APM'],
            ['title' => 'Action Peoples Party', 'abbr' => 'APP'],
            ['title' => 'Boot Party', 'abbr' => 'BP'],
            ['title' => 'Labour Party', 'abbr' => 'LP'],
            ['title' => 'National Rescue Movement', 'abbr' => 'NRM'],
            ['title' => 'New Nigeria Peoples Party', 'abbr' => 'NNPP'],
            ['title' => 'Peoples Democratic Party', 'abbr' => 'PDP'],
            ['title' => 'Peoples Redemption Party', 'abbr' => 'PRP'],
            ['title' => 'Social Democratic Party', 'abbr' => 'SDP'],
            ['title' => 'Young Progressive Party', 'abbr' => 'YPP'],
            ['title' => 'Youth Party', 'abbr' => 'YP'],
            ['title' => 'Zenith Labour Party', 'abbr' => 'ZLP'],
        ];

        foreach ($parties as $party) {
            DB::table('political_parties')->insert([
                'title' => $party['title'],
                'abbr' => $party['abbr'],
                'status' => 'Active'
            ]);
        }
    }
}
