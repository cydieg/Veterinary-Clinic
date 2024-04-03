<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveDoctorNameFromBranchesTable extends Migration
{
    public function up()
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn('doctor_name');
        });
    }

    public function down()
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->string('doctor_name')->nullable();
        });
    }
}
