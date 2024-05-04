<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameCheckOutColumnInAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->renameColumn('check_out', 'check_out_date');
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->renameColumn('check_out_date', 'check_out');
        });
    }
}
