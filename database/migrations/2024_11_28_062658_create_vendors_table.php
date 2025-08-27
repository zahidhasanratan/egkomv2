<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('hotel_name');
            $table->string('contact_person_name');
            $table->date('contact_person_dob')->nullable();
            $table->string('contact_person_designation')->nullable();
            $table->string('phone');
            $table->string('email');
            $table->string('address_house')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_district')->nullable();
            $table->string('address_area')->nullable();
            $table->string('address_landmark')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('logo')->nullable();
            $table->json('hotel_pictures')->nullable();
            $table->string('bank_check_picture')->nullable();
            $table->string('nid')->nullable();
            $table->string('trade_license_bin_tin')->nullable();
            $table->string('bank_details')->nullable();
            $table->string('password');
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
        Schema::dropIfExists('vendors');
    }
}
