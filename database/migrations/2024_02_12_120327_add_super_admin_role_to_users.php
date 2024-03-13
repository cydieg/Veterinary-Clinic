<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSuperAdminRoleToUsers extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Set 'super_admin' as the default value for the 'role' column
            $table->string('role')->default('super_admin')->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert the default value for the 'role' column to 'patient'
            $table->string('role')->default('patient')->change();
        });
    }
}

