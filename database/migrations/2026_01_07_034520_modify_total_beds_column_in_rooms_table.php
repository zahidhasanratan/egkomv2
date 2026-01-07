<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ModifyTotalBedsColumnInRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Modify total_beds to be nullable with default 0
            if (Schema::hasColumn('rooms', 'total_beds')) {
                // For MySQL/MariaDB
                DB::statement('ALTER TABLE `rooms` MODIFY COLUMN `total_beds` INT(11) NULL DEFAULT 0');
            } else {
                // If column doesn't exist, create it
                $table->integer('total_beds')->nullable()->default(0);
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
        Schema::table('rooms', function (Blueprint $table) {
            // Revert to non-nullable (if needed)
            if (Schema::hasColumn('rooms', 'total_beds')) {
                DB::statement('ALTER TABLE `rooms` MODIFY COLUMN `total_beds` INT(11) NOT NULL DEFAULT 0');
            }
        });
    }
}
