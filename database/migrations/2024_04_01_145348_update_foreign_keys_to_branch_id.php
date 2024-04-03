<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeysToBranchId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->renameColumn('clinic_id', 'branch_id');
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->renameColumn('clinic_id', 'branch_id');
        });

        // Add more tables here if needed
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->renameColumn('branch_id', 'clinic_id');
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->renameColumn('branch_id', 'clinic_id');
        });

        // Add more tables here if needed
    }
}
