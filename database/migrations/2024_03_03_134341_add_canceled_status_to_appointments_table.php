<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCanceledStatusToAppointmentsTable extends Migration
{
    public function up()
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Modify the status column to include the 'canceled' option
            $table->enum('status', ['pending', 'accepted', 'completed', 'canceled'])
                  ->default('pending')
                  ->change();
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Rollback logic if needed
        });
    }
}
