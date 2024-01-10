<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('order_detail_product', function (Blueprint $table) {
            $table->renameColumn('orderdetail_id', 'order_detail_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_detail_product', function (Blueprint $table) {
            $table->renameColumn('order_detail_id', 'orderdetail_id');
        });
    }
};
