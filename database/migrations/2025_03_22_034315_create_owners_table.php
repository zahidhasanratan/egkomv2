<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOwnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number')->nullable();
            $table->string('ownership_type')->nullable(); // Commercial/Private/Others
            $table->string('trade_license')->nullable();
            $table->string('bin')->nullable();
            $table->string('tin')->nullable();
            $table->string('nid_number')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('passport_number')->nullable();
            $table->text('present_address')->nullable();
            $table->text('permanent_address')->nullable();
            $table->string('property_ownership')->nullable(); // Proprietorship/Partnership/etc
            $table->string('partner_name')->nullable();
            $table->string('partner_contact')->nullable();
            $table->text('partner_details')->nullable();
            $table->date('lease_start_date')->nullable();
            $table->date('lease_end_date')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('website_link')->nullable();
            $table->string('nid_front_image')->nullable();
            $table->string('nid_back_image')->nullable();
            $table->string('status')->default('draft'); // draft/submitted
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('owners');
    }
}
