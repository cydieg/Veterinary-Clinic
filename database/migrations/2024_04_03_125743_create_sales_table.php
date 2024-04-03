<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('inventory_id');
            $table->integer('quantity_sold');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['pending', 'delivering', 'delivered']);
            $table->foreign('inventory_id')->references('id')->on('inventories')->onDelete('cascade');
            // Add foreign key constraint for user_id if necessary
        });
    }

    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
