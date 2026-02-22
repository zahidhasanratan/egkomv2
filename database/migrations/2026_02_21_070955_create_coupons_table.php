<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code', 64)->unique();
            $table->string('description')->nullable();
            $table->enum('discount_type', ['percentage', 'fixed'])->default('percentage');
            $table->decimal('discount_value', 12, 2);
            $table->date('valid_from');
            $table->date('valid_to');
            $table->unsignedInteger('usage_limit')->nullable()->comment('Max total uses; null = unlimited');
            $table->unsignedInteger('usage_count')->default(0);
            $table->boolean('apply_to_all_hotels')->default(true);
            $table->json('hotel_ids')->nullable()->comment('Hotel IDs when apply_to_all_hotels is false');
            $table->decimal('min_booking_amount', 12, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
