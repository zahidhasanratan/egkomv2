<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomAndEnabledCancellationPoliciesToHotelsAndRoomsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hotels', function (Blueprint $table) {
            if (!Schema::hasColumn('hotels', 'custom_cancellation_policies')) {
                $table->json('custom_cancellation_policies')->nullable()->after('cancellation_policy_texts');
            }
            if (!Schema::hasColumn('hotels', 'enabled_cancellation_policies')) {
                $table->json('enabled_cancellation_policies')->nullable()->after('custom_cancellation_policies');
            }
        });

        Schema::table('rooms', function (Blueprint $table) {
            if (!Schema::hasColumn('rooms', 'custom_cancellation_policies')) {
                $table->json('custom_cancellation_policies')->nullable()->after('cancellation_policy_texts');
            }
            if (!Schema::hasColumn('rooms', 'enabled_cancellation_policies')) {
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
        Schema::table('hotels', function (Blueprint $table) {
            if (Schema::hasColumn('hotels', 'custom_cancellation_policies')) {
                $table->dropColumn('custom_cancellation_policies');
            }
            if (Schema::hasColumn('hotels', 'enabled_cancellation_policies')) {
                $table->dropColumn('enabled_cancellation_policies');
            }
        });

        Schema::table('rooms', function (Blueprint $table) {
            if (Schema::hasColumn('rooms', 'custom_cancellation_policies')) {
                $table->dropColumn('custom_cancellation_policies');
            }
            if (Schema::hasColumn('rooms', 'enabled_cancellation_policies')) {
                $table->dropColumn('enabled_cancellation_policies');
            }
        });
    }
}
