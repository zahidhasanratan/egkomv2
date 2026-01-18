<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoomCancellationPoliciesToHotelSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotel_settings', function (Blueprint $table) {
            // Add room-specific fields
            // Note: Existing cancellation_policy_texts, custom_cancellation_policies, enabled_cancellation_policies are treated as hotel-specific
            if (!Schema::hasColumn('hotel_settings', 'room_cancellation_policy_texts')) {
                $table->json('room_cancellation_policy_texts')->nullable()->after('enabled_cancellation_policies');
            }
            if (!Schema::hasColumn('hotel_settings', 'room_custom_cancellation_policies')) {
                $table->json('room_custom_cancellation_policies')->nullable()->after('room_cancellation_policy_texts');
            }
            if (!Schema::hasColumn('hotel_settings', 'room_enabled_cancellation_policies')) {
                $table->json('room_enabled_cancellation_policies')->nullable()->after('room_custom_cancellation_policies');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotel_settings', function (Blueprint $table) {
            if (Schema::hasColumn('hotel_settings', 'room_enabled_cancellation_policies')) {
                $table->dropColumn('room_enabled_cancellation_policies');
            }
            if (Schema::hasColumn('hotel_settings', 'room_custom_cancellation_policies')) {
                $table->dropColumn('room_custom_cancellation_policies');
            }
            if (Schema::hasColumn('hotel_settings', 'room_cancellation_policy_texts')) {
                $table->dropColumn('room_cancellation_policy_texts');
            }
        });
    }
}
