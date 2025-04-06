<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventords', function (Blueprint $table) {
            $table->id();
            $table->string('hotel_name');
            $table->string('contact_person_name');
            $table->date('contact_person_dob')->nullable();
            $table->string('contact_person_designation')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('logo')->nullable();
            $table->json('hotel_pictures')->nullable(); // Multiple images
            $table->string('address_house')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_district')->nullable();
            $table->string('address_area')->nullable();
            $table->string('address_landmark')->nullable();
            $table->string('address_post_code')->nullable();
            $table->point('location_tag')->nullable(); // Geo-coordinates
            $table->text('about_hotel')->nullable();
            $table->integer('total_rooms')->nullable();
            $table->json('room_types')->nullable(); // JSON to store room types
            $table->string('legal_property_name')->nullable();
            $table->string('property_type')->nullable(); // Simple string
            $table->string('hotel_category')->nullable(); // Simple string
            $table->string('nid')->nullable();
            $table->string('trade_license_bin_tin')->nullable();
            $table->string('bank_details')->nullable();
            $table->string('bank_check_picture')->nullable();
            $table->string('password'); // Hash this field during user registration
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('ventords');
    }
}
