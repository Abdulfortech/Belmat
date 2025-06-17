<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            ['title' => 'Abia', 'code' => 'AB', 'status' => 'Active'],
            ['title' => 'Adamawa', 'code' => 'AD', 'status' => 'Active'],
            ['title' => 'Akwa Ibom', 'code' => 'AK', 'status' => 'Active'],
            ['title' => 'Anambra', 'code' => 'AN', 'status' => 'Active'],
            ['title' => 'Bauchi', 'code' => 'BA', 'status' => 'Active'],
            ['title' => 'Bayelsa', 'code' => 'BY', 'status' => 'Active'],
            ['title' => 'Benue', 'code' => 'BE', 'status' => 'Active'],
            ['title' => 'Borno', 'code' => 'BO', 'status' => 'Active'],
            ['title' => 'Cross River', 'code' => 'CR', 'status' => 'Active'],
            ['title' => 'Delta', 'code' => 'DE', 'status' => 'Active'],
            ['title' => 'Ebonyi', 'code' => 'EB', 'status' => 'Active'],
            ['title' => 'Edo', 'code' => 'ED', 'status' => 'Active'],
            ['title' => 'Ekiti', 'code' => 'EK', 'status' => 'Active'],
            ['title' => 'Enugu', 'code' => 'EN', 'status' => 'Active'],
            ['title' => 'FCT - Abuja', 'code' => 'FCT', 'status' => 'Active'],
            ['title' => 'Gombe', 'code' => 'GO', 'status' => 'Active'],
            ['title' => 'Imo', 'code' => 'IM', 'status' => 'Active'],
            ['title' => 'Jigawa', 'code' => 'JI', 'status' => 'Active'],
            ['title' => 'Kaduna', 'code' => 'KD', 'status' => 'Active'],
            ['title' => 'Kano', 'code' => 'KN', 'status' => 'Active'],
            ['title' => 'Katsina', 'code' => 'KT', 'status' => 'Active'],
            ['title' => 'Kebbi', 'code' => 'KB', 'status' => 'Active'],
            ['title' => 'Kogi', 'code' => 'KG', 'status' => 'Active'],
            ['title' => 'Kwara', 'code' => 'KW', 'status' => 'Active'],
            ['title' => 'Lagos', 'code' => 'LA', 'status' => 'Active'],
            ['title' => 'Nasarawa', 'code' => 'NA', 'status' => 'Active'],
            ['title' => 'Niger', 'code' => 'NI', 'status' => 'Active'],
            ['title' => 'Ogun', 'code' => 'OG', 'status' => 'Active'],
            ['title' => 'Ondo', 'code' => 'ON', 'status' => 'Active'],
            ['title' => 'Osun', 'code' => 'OS', 'status' => 'Active'],
            ['title' => 'Oyo', 'code' => 'OY', 'status' => 'Active'],
            ['title' => 'Plateau', 'code' => 'PL', 'status' => 'Active'],
            ['title' => 'Rivers', 'code' => 'RI', 'status' => 'Active'],
            ['title' => 'Sokoto', 'code' => 'SO', 'status' => 'Active'],
            ['title' => 'Taraba', 'code' => 'TA', 'status' => 'Active'],
            ['title' => 'Yobe', 'code' => 'YO', 'status' => 'Active'],
            ['title' => 'Zamfara', 'code' => 'ZA', 'status' => 'Active'],
        ];

        DB::table('states')->insert($states);
    }
}
