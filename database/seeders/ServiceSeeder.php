<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        DB::table('services')->insert([
            [
                'name' => 'General Check-up',
                'duration_minutes' => 30,
                'cost' => 150.00,
                'description' => 'Initial consultation and basic health screening.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Specialist Consultation',
                'duration_minutes' => 60,
                'cost' => 250.00,
                'description' => 'In-depth examination with a specialized practitioner.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Vaccination Administration',
                'duration_minutes' => 15,
                'cost' => 75.00,
                'description' => 'Standard immunization service.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Minor Procedure',
                'duration_minutes' => 45,
                'cost' => 300.00,
                'description' => 'Includes services like suture removal or wound care.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
