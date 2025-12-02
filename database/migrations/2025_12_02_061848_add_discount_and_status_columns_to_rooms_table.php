<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountAndStatusColumnsToRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Check and add discount_amount and discount_percentage columns if they don't exist
            if (!Schema::hasColumn('rooms', 'discount_amount')) {
                $table->decimal('discount_amount', 10, 2)->nullable()->after('discount_type');
            }
            if (!Schema::hasColumn('rooms', 'discount_percentage')) {
                $table->decimal('discount_percentage', 10, 2)->nullable()->after('discount_amount');
            }
            
            // Add status column if it doesn't exist
            if (!Schema::hasColumn('rooms', 'status')) {
                $table->string('status')->default('published')->after('is_active');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->dropColumn(['discount_amount', 'discount_percentage', 'status']);
            // Note: reverting cancellation_policy to string would require additional handling
        });
    }
}
