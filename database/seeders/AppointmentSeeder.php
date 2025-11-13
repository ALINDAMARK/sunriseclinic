<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppointmentSeeder extends Seeder
{
    public function run()
    {
        // create a few appointments linking existing patients, doctors and services
        $patients = DB::table('patients')->pluck('id')->toArray();
        $doctors = DB::table('doctors')->pluck('id')->toArray();
        $services = DB::table('services')->pluck('id')->toArray();

        if (empty($patients) || empty($doctors) || empty($services)) {
            return; // nothing to seed yet
        }

        $now = Carbon::now();

        DB::table('appointments')->insert([
            [
                'patient_id' => $patients[array_rand($patients)],
                'doctor_id' => $doctors[array_rand($doctors)],
                'service_id' => $services[array_rand($services)],
                'starts_at' => $now->copy()->addDays(1)->setTime(9,0),
                'duration_minutes' => 30,
                'status' => 'scheduled',
                'notes' => 'Initial appointment (seeded).',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'patient_id' => $patients[array_rand($patients)],
                'doctor_id' => $doctors[array_rand($doctors)],
                'service_id' => $services[array_rand($services)],
                'starts_at' => $now->copy()->addDays(2)->setTime(10,0),
                'duration_minutes' => 45,
                'status' => 'scheduled',
                'notes' => 'Follow-up appointment (seeded).',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
