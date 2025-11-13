<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DoctorSeeder extends Seeder
{
    public function run()
    {
        DB::table('doctors')->insert([
            ['name' => 'Dr. Evelyn Reed', 'specialty' => 'General Medicine', 'avatar_url' => '', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dr. Marcus Thorne', 'specialty' => 'Cardiology', 'avatar_url' => '', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Dr. Alan Grant', 'specialty' => 'Surgery', 'avatar_url' => '', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
