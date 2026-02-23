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
        Schema::table('bookings', function (Blueprint $table) {
            $table->decimal('commission_amount', 10, 2)->nullable()->default(0)->after('subtotal')->comment('Commission amount charged');
            $table->decimal('commission_percentage', 5, 2)->nullable()->after('commission_amount')->comment('Commission % at time of booking');
            $table->decimal('platform_discount', 10, 2)->nullable()->default(0)->after('discount')->comment('Platform discount amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['commission_amount', 'commission_percentage', 'platform_discount']);
        });
    }
};
