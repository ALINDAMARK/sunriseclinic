<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ServiceSeeder;
use Database\Seeders\DoctorSeeder;
use Database\Seeders\PatientSeeder;
use Database\Seeders\AppointmentSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seed sample data for development
        $this->call([
            ServiceSeeder::class,
            DoctorSeeder::class,
            PatientSeeder::class,
            AppointmentSeeder::class,
        ]);
    }
}
