<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdditionalInfoNoteFieldsToRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Additional Bed Policy fields
            $table->enum('additional_bed_available', ['yes', 'no'])->nullable()->after('display_options');
            $table->enum('bed_fee_type', ['free', 'paid'])->nullable()->after('additional_bed_available');
            $table->decimal('bed_fee_amount', 10, 2)->nullable()->after('bed_fee_type');
            $table->string('bed_fee_currency', 10)->nullable()->after('bed_fee_amount');
            $table->string('bed_fee_unit', 50)->nullable()->after('bed_fee_currency');
            $table->text('bed_note')->nullable()->after('bed_fee_unit');
            
            // Children & Extra Guest Policy fields
            $table->enum('children_guest_policy_available', ['yes', 'no'])->nullable()->after('bed_note');
            $table->enum('children_guest_policy_type', ['complementary', 'paid'])->nullable()->after('children_guest_policy_available');
            $table->decimal('children_guest_fee_amount', 10, 2)->nullable()->after('children_guest_policy_type');
            $table->string('children_guest_fee_currency', 10)->nullable()->after('children_guest_fee_amount');
            $table->string('children_guest_fee_unit', 50)->nullable()->after('children_guest_fee_currency');
            $table->text('children_guest_note')->nullable()->after('children_guest_fee_unit');
            
            // Laundry Service fields
            $table->enum('laundry_service', ['yes', 'no'])->nullable()->after('children_guest_note');
            $table->enum('laundry_service_type', ['complementary', 'paid'])->nullable()->after('laundry_service');
            $table->decimal('laundry_fee_amount', 10, 2)->nullable()->after('laundry_service_type');
            $table->string('laundry_fee_currency', 10)->nullable()->after('laundry_fee_amount');
            $table->string('laundry_fee_unit', 50)->nullable()->after('laundry_fee_currency');
            $table->text('laundry_note')->nullable()->after('laundry_fee_unit');
            
            // Housekeeping Service fields
            $table->enum('housekeeping_service', ['yes', 'no'])->nullable()->after('laundry_note');
            $table->enum('housekeeping_service_type', ['complementary', 'paid'])->nullable()->after('housekeeping_service');
            $table->decimal('housekeeping_fee_amount', 10, 2)->nullable()->after('housekeeping_service_type');
            $table->string('housekeeping_fee_currency', 10)->nullable()->after('housekeeping_fee_amount');
            $table->string('housekeeping_fee_unit', 50)->nullable()->after('housekeeping_fee_currency');
            $table->text('housekeeping_note')->nullable()->after('housekeeping_fee_unit');
            
            // Parking fields
            $table->enum('parking_type', ['available', 'paid', 'not_available'])->nullable()->after('housekeeping_note');
            $table->decimal('parking_fee_amount', 10, 2)->nullable()->after('parking_type');
            $table->string('parking_fee_currency', 10)->nullable()->after('parking_fee_amount');
            $table->text('parking_note')->nullable()->after('parking_fee_currency');
            
            // Pet Policy fields
            $table->enum('pet_type', ['complementary', 'paid', 'not_available'])->nullable()->after('parking_note');
            $table->string('pet_fee', 255)->nullable()->after('pet_type');
            $table->text('pet_complementary_note')->nullable()->after('pet_fee');
            $table->string('pet_paid_note', 255)->nullable()->after('pet_complementary_note');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Additional Bed Policy fields
            $table->dropColumn([
                'additional_bed_available',
                'bed_fee_type',
                'bed_fee_amount',
                'bed_fee_currency',
                'bed_fee_unit',
                'bed_note',
            ]);
            
            // Children & Extra Guest Policy fields
            $table->dropColumn([
                'children_guest_policy_available',
                'children_guest_policy_type',
                'children_guest_fee_amount',
                'children_guest_fee_currency',
                'children_guest_fee_unit',
                'children_guest_note',
            ]);
            
            // Laundry Service fields
            $table->dropColumn([
                'laundry_service',
                'laundry_service_type',
                'laundry_fee_amount',
                'laundry_fee_currency',
                'laundry_fee_unit',
                'laundry_note',
            ]);
            
            // Housekeeping Service fields
            $table->dropColumn([
                'housekeeping_service',
                'housekeeping_service_type',
                'housekeeping_fee_amount',
                'housekeeping_fee_currency',
                'housekeeping_fee_unit',
                'housekeeping_note',
            ]);
            
            // Parking fields
            $table->dropColumn([
                'parking_type',
                'parking_fee_amount',
                'parking_fee_currency',
                'parking_note',
            ]);
            
            // Pet Policy fields
            $table->dropColumn([
                'pet_type',
                'pet_fee',
                'pet_complementary_note',
                'pet_paid_note',
            ]);
        });
    }
}
