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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('customer_id');
        $table->decimal('total_price', 10, 2);
        $table->string('order_number')->unique();  // Will be generated automatically
        $table->string('status')->default('Pending');
        $table->timestamps();
        
        // Add the foreign key constraint
        $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
    });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
