<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCourierIdToSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->unsignedBigInteger('courier_id')->nullable(); // Change the data type according to your courier table
            $table->foreign('courier_id')->references('id')->on('couriers')->onDelete('set null'); // Adjust the reference table and column name as per your courier table structure
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign(['courier_id']);
            $table->dropColumn('courier_id');
        });
    }
}
