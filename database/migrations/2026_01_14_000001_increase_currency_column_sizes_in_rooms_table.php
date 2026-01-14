<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Increase currency column sizes to accommodate longer values
            $table->string('bed_fee_currency', 100)->nullable()->change();
            $table->string('children_guest_fee_currency', 100)->nullable()->change();
            $table->string('laundry_fee_currency', 100)->nullable()->change();
            $table->string('housekeeping_fee_currency', 100)->nullable()->change();
            $table->string('parking_fee_currency', 100)->nullable()->change();
            
            // Also increase unit column sizes in case they need more space
            $table->string('bed_fee_unit', 100)->nullable()->change();
            $table->string('children_guest_fee_unit', 100)->nullable()->change();
            $table->string('laundry_fee_unit', 100)->nullable()->change();
            $table->string('housekeeping_fee_unit', 100)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Revert to original sizes
            $table->string('bed_fee_currency', 10)->nullable()->change();
            $table->string('children_guest_fee_currency', 10)->nullable()->change();
            $table->string('laundry_fee_currency', 10)->nullable()->change();
            $table->string('housekeeping_fee_currency', 10)->nullable()->change();
            $table->string('parking_fee_currency', 10)->nullable()->change();
            
            $table->string('bed_fee_unit', 50)->nullable()->change();
            $table->string('children_guest_fee_unit', 50)->nullable()->change();
            $table->string('laundry_fee_unit', 50)->nullable()->change();
            $table->string('housekeeping_fee_unit', 50)->nullable()->change();
        });
    }
};

