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
        Schema::table('hotel_settings', function (Blueprint $table) {
            $table->decimal('commission_percentage', 5, 2)->nullable()->default(0)->after('copyright')->comment('Platform commission % charged from vendors');
            $table->boolean('platform_fee_enabled')->default(false)->after('commission_percentage');
            $table->decimal('platform_fee_amount', 10, 2)->nullable()->default(0)->after('platform_fee_enabled')->comment('Flat platform fee per booking');
            $table->boolean('tax_enabled')->default(false)->after('platform_fee_amount');
            $table->decimal('tax_percentage', 5, 2)->nullable()->default(0)->after('tax_enabled')->comment('Tax % applied when enabled');
            $table->boolean('platform_discount_enabled')->default(false)->after('tax_percentage');
            $table->decimal('platform_discount_percentage', 5, 2)->nullable()->default(0)->after('platform_discount_enabled');
            $table->boolean('platform_discount_apply_to_all_hotels')->default(true)->after('platform_discount_percentage');
            $table->json('platform_discount_hotel_ids')->nullable()->after('platform_discount_apply_to_all_hotels')->comment('Hotel IDs when not apply to all');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hotel_settings', function (Blueprint $table) {
            $table->dropColumn([
                'commission_percentage',
                'platform_fee_enabled',
                'platform_fee_amount',
                'tax_enabled',
                'tax_percentage',
                'platform_discount_enabled',
                'platform_discount_percentage',
                'platform_discount_apply_to_all_hotels',
                'platform_discount_hotel_ids',
            ]);
        });
    }
};
