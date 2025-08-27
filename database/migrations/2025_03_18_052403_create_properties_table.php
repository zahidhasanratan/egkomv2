<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('property_name');
            $table->string('property_category');
            $table->string('property_type')->nullable();
            $table->json('room_types')->nullable(); // For room type checkboxes
            $table->string('country_name');
            $table->string('district_name');
            $table->string('city_town_village')->nullable();
            $table->string('postcode')->nullable();
            $table->string('house_number')->nullable();
            $table->string('road_number_name')->nullable();
            $table->integer('building_age')->nullable();
            $table->integer('building_size')->nullable();
            $table->integer('building_stories')->nullable();
            $table->text('landmark_details')->nullable();
            $table->string('google_map_link')->nullable();
            $table->json('logo_paths')->nullable(); // For multiple logo uploads
            $table->integer('apartment_count')->nullable();
            $table->json('apartments')->nullable(); // For apartment details
            $table->integer('total_capacity')->nullable();
            $table->integer('car_parking')->nullable();
            $table->boolean('has_reception')->default(false);
            $table->integer('elevators')->nullable();
            $table->integer('generators')->nullable();
            $table->integer('fire_exits')->nullable();
            $table->boolean('wheelchair_access')->default(false);
            $table->integer('male_housekeeping')->nullable();
            $table->integer('female_housekeeping')->nullable();
            $table->boolean('has_kids_zone')->default(false);
            $table->integer('kids_zone_count')->nullable();
            $table->string('view_type')->nullable();
            $table->integer('security_guards')->nullable();
            $table->boolean('has_cafe_restaurant')->default(false);
            $table->integer('cafe_restaurant_count')->nullable();
            $table->json('cafe_restaurant_names')->nullable(); // For cafe/restaurant names
            $table->boolean('has_pool')->default(false);
            $table->integer('pool_count')->nullable();
            $table->boolean('has_bar')->default(false);
            $table->integer('bar_count')->nullable();
            $table->boolean('has_gym')->default(false);
            $table->integer('gym_count')->nullable();
            $table->boolean('has_party_center')->default(false);
            $table->text('party_center_details')->nullable();
            $table->boolean('has_conference_hall')->default(false);
            $table->text('conference_hall_details')->nullable();
            $table->string('status')->default('draft'); // For draft/submitted status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
