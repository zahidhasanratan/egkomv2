<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingColumnsToHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->json('custom_check_in_methods')->nullable()->after('check_in_methods');
            $table->json('custom_facilities')->nullable()->after('facilities');
            $table->json('custom_nearby_area_details')->nullable()->after('nearby_area_category');
            $table->json('property_types')->nullable()->after('amenities_photos');
            $table->json('apartments')->nullable()->after('property_types');
        });
    }

    public function down()
    {
        Schema::table('hotels', function (Blueprint $table) {
            $table->dropColumn([
                'custom_check_in_methods',
                'custom_facilities',
                'custom_nearby_area_details',
                'property_types',
                'apartments',
            ]);
        });
    }
}
