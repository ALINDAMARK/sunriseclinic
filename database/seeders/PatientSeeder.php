<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PatientSeeder extends Seeder
{
    public function run()
    {
        DB::table('patients')->insert([
            ['name' => 'Liam Johnson', 'email' => 'liam.johnson@example.com', 'phone' => '+15551230001', 'dob' => '1986-04-12', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Olivia Brown', 'email' => 'olivia.brown@example.com', 'phone' => '+15551230002', 'dob' => '1990-07-23', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ava Miller', 'email' => 'ava.miller@example.com', 'phone' => '+15551230003', 'dob' => '1995-02-11', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
