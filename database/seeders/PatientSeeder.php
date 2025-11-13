<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PatientSeeder extends Seeder
{
    public function run()
    {
        // Add a demo patient (Eleanor Pena) if not already present
        $exists = DB::table('patients')->where('email', 'eleanor.pena@example.com')->first();
        if (! $exists) {
            DB::table('patients')->insert([
                ['name' => 'Eleanor Pena', 'email' => 'eleanor.pena@example.com', 'phone' => '(219) 555-0114', 'dob' => '1988-05-15', 'gender' => 'Female', 'marital_status' => 'Single', 'address' => '2715 Ash Dr. San Jose, South Dakota 83475', 'emergency_contact_name' => 'Ronald Richards (Father)', 'emergency_contact_phone' => '(308) 555-0121', 'allergies' => 'Penicillin', 'conditions' => 'Mild Asthma', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ]);
        }

    // existing sample patients (ensure they exist too)
        DB::table('patients')->insertOrIgnore([
            ['name' => 'Liam Johnson', 'email' => 'liam.johnson@example.com', 'phone' => '+15551230001', 'dob' => '1986-04-12', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Olivia Brown', 'email' => 'olivia.brown@example.com', 'phone' => '+15551230002', 'dob' => '1990-07-23', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ava Miller', 'email' => 'ava.miller@example.com', 'phone' => '+15551230003', 'dob' => '1995-02-11', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
