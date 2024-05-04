<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCheckOutToAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->timestamp('check_out')->nullable();
        });
    }

    public function down()
    {
        // If you ever need to rollback this migration, you can drop the column here
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('check_out');
        });
    }
}
