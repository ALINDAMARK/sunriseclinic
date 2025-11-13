<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CreateAdminUserSeeder extends Seeder
{
    public function run()
    {
        try {
            $email = 'admin@sunriseclinic.local';
            $u = \App\Models\User::where('email', $email)->first();
            if (!$u) {
                $u = \App\Models\User::create([
                    'name' => 'Admin User',
                    'email' => $email,
                    'password' => bcrypt('password'),
                    'is_admin' => true,
                ]);
                $this->command->info('Created admin user: ' . $email . ' (password: password)');
            } else {
                $u->is_admin = true;
                $u->save();
                $this->command->info('Updated existing user to admin: ' . $email);
            }
        } catch (\Exception $e) {
            $this->command->error('Seeder error: ' . $e->getMessage());
        }
    }
}
