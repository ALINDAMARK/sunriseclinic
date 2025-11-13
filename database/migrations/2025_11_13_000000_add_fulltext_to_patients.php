<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Adds a FULLTEXT index on patients(name,email,phone) when using MySQL/MariaDB.
     */
    public function up()
    {
        $driver = DB::getDriverName();
        if (!in_array($driver, ['mysql', 'mariadb'])) {
            return;
        }

        if (!Schema::hasTable('patients')) {
            return;
        }

        try {
            DB::statement('ALTER TABLE `patients` ADD FULLTEXT `ft_patients_name_email_phone` (`name`,`email`,`phone`)');
        } catch (\Exception $e) {
            // ignore if index already exists or cannot be created
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        $driver = DB::getDriverName();
        if (!in_array($driver, ['mysql', 'mariadb'])) {
            return;
        }

        if (!Schema::hasTable('patients')) {
            return;
        }

        try {
            DB::statement('ALTER TABLE `patients` DROP INDEX `ft_patients_name_email_phone`');
        } catch (\Exception $e) {
            // ignore
        }
    }
};
