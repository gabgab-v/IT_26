<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderTrackingFieldsToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->timestamp('date_ordered')->nullable(); // Date when order was placed
            $table->timestamp('estimated_date_of_arrival')->nullable(); // Estimated delivery date
            $table->integer('duration_of_order')->nullable(); // Duration in days or hours
            $table->decimal('weight', 8, 2)->nullable(); // Weight in kg or lbs
            $table->boolean('is_delivered')->default(false); // Delivery status
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'date_ordered', 
                'estimated_date_of_arrival', 
                'duration_of_order', 
                'weight', 
                'is_delivered'
            ]);
        });
    }
}
