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
        Schema::table('orders', function (Blueprint $table) {
            // Check if 'customer_id' exists, and drop it if present
            if (Schema::hasColumn('orders', 'customer_id')) {
                $table->dropForeign(['customer_id']); // Drop foreign key first
                $table->dropColumn('customer_id');   // Drop the column
            }
    
            // Check if 'user_id' exists, and only add it if not present
            if (!Schema::hasColumn('orders', 'user_id')) {
                $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->after('id');
            }
        });
    }
    
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Re-add 'customer_id' if rolling back
            if (!Schema::hasColumn('orders', 'customer_id')) {
                $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete()->after('id');
            }
    
            // Drop 'user_id' if rolling back
            if (Schema::hasColumn('orders', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
    
    
};
