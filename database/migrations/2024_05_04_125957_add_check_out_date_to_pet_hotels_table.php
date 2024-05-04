<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pet_hotels', function (Blueprint $table) {
            $table->date('check_out_date')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('pet_hotels', function (Blueprint $table) {
            $table->dropColumn('check_out_date');
        });
    }
};
