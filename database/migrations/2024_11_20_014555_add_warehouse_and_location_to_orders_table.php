<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'warehouse_id')) {
                $table->foreignId('warehouse_id')->constrained()->onDelete('cascade');
            }

            if (!Schema::hasColumn('orders', 'current_location')) {
                $table->string('current_location')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'warehouse_id')) {
                $table->dropForeign(['warehouse_id']);
                $table->dropColumn('warehouse_id');
            }

            if (Schema::hasColumn('orders', 'current_location')) {
                $table->dropColumn('current_location');
            }
        });
    }
};

