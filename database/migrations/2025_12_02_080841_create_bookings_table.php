<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            
            // Invoice Information
            $table->string('invoice_number')->unique();
            $table->enum('booking_status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('confirmed');
            
            // Guest Information
            $table->foreignId('guest_id')->nullable()->constrained('guests')->onDelete('set null');
            $table->string('guest_name');
            $table->string('guest_email')->nullable();
            $table->string('guest_phone');
            
            // Hotel/Room Information - Store cart data as JSON
            $table->json('rooms_data'); // Contains: [{roomId, roomName, quantity, price, hotelId, hotelName}]
            
            // Booking Dates
            $table->date('checkin_date');
            $table->date('checkout_date');
            $table->integer('total_nights');
            
            // Guest Count
            $table->integer('total_male')->default(0);
            $table->integer('total_female')->default(0);
            $table->integer('total_kids')->default(0);
            $table->integer('total_persons')->default(0);
            $table->json('other_guests')->nullable(); // Array of guest names
            
            // Contact & Address
            $table->text('home_address');
            $table->string('organization')->nullable();
            $table->string('organization_address')->nullable();
            
            // Relationship
            $table->enum('relationship', ['family', 'husband', 'friends', 'colleagues', 'onlyMe'])->default('onlyMe');
            
            // Additional Requests (Store as JSON array)
            $table->json('additional_requests')->nullable(); // ['airportTransfer', 'extraBed', etc.]
            
            // Room Preferences
            $table->enum('bed_type', ['large_bed', 'twin_beds'])->nullable();
            $table->enum('room_preference', ['non_smoking', 'smoking'])->default('non_smoking');
            $table->string('room_type')->nullable();
            $table->string('room_number')->nullable();
            
            // Arrival Information
            $table->string('arrival_time')->nullable();
            $table->text('property_note')->nullable();
            
            // Citizenship & Documents
            $table->enum('citizenship', ['bangladesh', 'international'])->nullable();
            $table->string('nid_front')->nullable();
            $table->string('nid_back')->nullable();
            $table->string('passport')->nullable();
            $table->string('visa')->nullable();
            
            // Pricing
            $table->decimal('subtotal', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('grand_total', 10, 2);
            $table->string('coupon_code')->nullable();
            
            // Payment Status (for future implementation)
            $table->enum('payment_status', ['unpaid', 'partial', 'paid'])->default('unpaid');
            $table->decimal('paid_amount', 10, 2)->default(0);
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
