<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveNumberOfDaysFromAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('number_of_days');
        });
    }

    public function down()
    {
        // If you ever need to rollback this migration, you can re-add the column here
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedInteger('number_of_days');
        });
    }
}
