<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSizeToPetHotelsTable extends Migration
{
    public function up()
    {
        Schema::table('pet_hotels', function (Blueprint $table) {
            $table->string('size')->nullable()->after('check_out_date');
        });
    }

    public function down()
    {
        Schema::table('pet_hotels', function (Blueprint $table) {
            $table->dropColumn('size');
        });
    }
}
