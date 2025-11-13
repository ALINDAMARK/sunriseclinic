<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class SmokeTestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
            'email' => 'smoketest@example.com'
        ], [
            'name' => 'Smoke Test',
            'password' => bcrypt('Sm0keT3st!')
        ]);
    }
}
