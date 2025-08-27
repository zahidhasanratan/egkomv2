<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('number');
            $table->integer('floor_number');
            $table->decimal('price_per_night', 10, 2);
            $table->decimal('weekend_price', 10, 2)->nullable();
            $table->decimal('holiday_price', 10, 2)->nullable();
            $table->string('discount_type')->nullable();
            $table->decimal('discount_value', 10, 2)->nullable();
            $table->integer('total_persons');
            $table->text('description')->nullable();
            $table->integer('size');
            $table->integer('total_rooms');
            $table->integer('total_washrooms');
            $table->integer('total_beds');
            $table->string('wifi_details')->nullable();
            $table->json('appliances')->nullable();
            $table->json('furniture')->nullable();
            $table->json('amenities')->nullable();
            $table->string('cancellation_policy')->nullable();
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
        Schema::dropIfExists('rooms');
    }
}
