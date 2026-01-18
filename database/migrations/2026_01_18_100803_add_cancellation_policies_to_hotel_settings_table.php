<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCancellationPoliciesToHotelSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotel_settings', function (Blueprint $table) {
            if (!Schema::hasColumn('hotel_settings', 'cancellation_policy_texts')) {
                $table->json('cancellation_policy_texts')->nullable()->after('copyright');
            }
            if (!Schema::hasColumn('hotel_settings', 'custom_cancellation_policies')) {
                $table->json('custom_cancellation_policies')->nullable()->after('cancellation_policy_texts');
            }
            if (!Schema::hasColumn('hotel_settings', 'enabled_cancellation_policies')) {
                $table->json('enabled_cancellation_policies')->nullable()->after('custom_cancellation_policies');
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
            if (Schema::hasColumn('hotel_settings', 'enabled_cancellation_policies')) {
                $table->dropColumn('enabled_cancellation_policies');
            }
            if (Schema::hasColumn('hotel_settings', 'custom_cancellation_policies')) {
                $table->dropColumn('custom_cancellation_policies');
            }
            if (Schema::hasColumn('hotel_settings', 'cancellation_policy_texts')) {
                $table->dropColumn('cancellation_policy_texts');
            }
        });
    }
}
