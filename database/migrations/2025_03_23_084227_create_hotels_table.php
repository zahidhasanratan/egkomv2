<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id')->nullable(); // Assuming a vendor owns the hotel
            $table->text('description')->nullable(); // Hotel/Property Description

            // Property Policy and Rules
            $table->string('pets_allowed')->nullable(); // 'yes' or 'no'
            $table->text('pets_details')->nullable();
            $table->string('events_allowed')->nullable(); // 'yes' or 'no'
            $table->text('events_details')->nullable();
            $table->string('smoking_allowed')->nullable(); // 'yes' or 'no'
            $table->text('smoking_details')->nullable();
            $table->string('quiet_hours')->nullable();
            $table->string('photography_allowed')->nullable(); // 'yes' or 'no'
            $table->text('photography_details')->nullable();
            $table->string('check_in_window')->nullable(); // e.g., '00:00-02:00'
            $table->string('check_out_time')->nullable(); // e.g., '1:00 AM'
            $table->string('food_laundry')->nullable(); // 'yes' or 'no'
            $table->json('check_in_rules')->nullable(); // Array of rules (e.g., ['Pay in advance', 'Rentals'])
            $table->json('custom_check_in_rules')->nullable(); // Dynamic custom rules

            // Property Info
            $table->json('property_info')->nullable(); // Array of selected options
            $table->json('custom_property_info')->nullable(); // Dynamic custom property info

            // Arrival Guides
            $table->string('age_restriction')->nullable(); // 'yes' or 'no'
            $table->text('age_restriction_details')->nullable();
            $table->string('vlogging_allowed')->nullable(); // 'yes' or 'no'
            $table->text('vlogging_details')->nullable();
            $table->text('child_policy')->nullable();
            $table->text('extra_bed_policy')->nullable();
            $table->text('cooking_policy')->nullable();
            $table->text('directions')->nullable();
            $table->text('additional_policy')->nullable();

            // Check-in Methods
            $table->json('check_in_methods')->nullable(); // Array of selected methods

            // Cancellation Policies
            $table->json('cancellation_policies')->nullable(); // Array of selected policies

            // Facilities
            $table->json('facilities')->nullable(); // Array of selected facilities
            $table->string('facility_category')->nullable(); // Selected category from dropdown

            // Nearby Area
            $table->json('nearby_areas')->nullable(); // Array of selected areas
            $table->json('custom_nearby_areas')->nullable(); // Dynamic custom areas
            $table->string('nearby_area_category')->nullable(); // Selected category from dropdown

            // Photos (stored as JSON array of file paths)
            $table->json('kitchen_photos')->nullable();
            $table->json('washroom_photos')->nullable();
            $table->json('parking_lot_photos')->nullable();
            $table->json('entrance_gate_photos')->nullable();
            $table->json('lift_stairs_photos')->nullable();
            $table->json('spa_photos')->nullable();
            $table->json('bar_photos')->nullable();
            $table->json('transport_photos')->nullable();
            $table->json('rooftop_photos')->nullable();
            $table->json('gym_photos')->nullable();
            $table->json('security_photos')->nullable();
            $table->json('amenities_photos')->nullable();

            // Status
            $table->string('status')->default('draft'); // 'draft' or 'submitted'

            $table->timestamps();

            // Foreign key (assuming vendors table exists)
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotels');
    }
}
