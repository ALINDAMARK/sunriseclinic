<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MakeAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            $u = \App\Models\User::find(1);
            if ($u) {
                $u->is_admin = true;
                $u->save();
                $this->command->info('Set is_admin for user #1');
            } else {
                $this->command->info('No user with ID 1 found');
            }
        } catch (\Exception $e) {
            $this->command->error('Seeder error: ' . $e->getMessage());
        }
    }
}
