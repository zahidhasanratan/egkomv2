<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            if (!Schema::hasColumn('hotels', 'cancellation_policy_texts')) {
                $table->json('cancellation_policy_texts')->nullable()->after('cancellation_policies');
            }
        });

        Schema::table('rooms', function (Blueprint $table) {
            if (!Schema::hasColumn('rooms', 'cancellation_policy_texts')) {
                $table->json('cancellation_policy_texts')->nullable()->after('cancellation_policy');
            }
        });
    }

    public function down(): void
    {
        Schema::table('hotels', function (Blueprint $table) {
            if (Schema::hasColumn('hotels', 'cancellation_policy_texts')) {
                $table->dropColumn('cancellation_policy_texts');
            }
        });

        Schema::table('rooms', function (Blueprint $table) {
            if (Schema::hasColumn('rooms', 'cancellation_policy_texts')) {
                $table->dropColumn('cancellation_policy_texts');
            }
        });
    }
};


