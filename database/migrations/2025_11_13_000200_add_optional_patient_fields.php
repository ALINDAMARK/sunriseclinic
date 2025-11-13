<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (! Schema::hasTable('patients')) {
            return;
        }
        Schema::table('patients', function (Blueprint $table) {
            $table->string('gender')->nullable()->after('dob');
            $table->string('marital_status')->nullable()->after('gender');
            $table->text('address')->nullable()->after('marital_status');
            $table->string('emergency_contact_name')->nullable()->after('address');
            $table->string('emergency_contact_phone')->nullable()->nullable()->after('emergency_contact_name');
            $table->text('allergies')->nullable()->after('emergency_contact_phone');
            $table->text('conditions')->nullable()->after('allergies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (! Schema::hasTable('patients')) {
            return;
        }
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn([
                'gender','marital_status','address','emergency_contact_name','emergency_contact_phone','allergies','conditions'
            ]);
        });
    }
};
