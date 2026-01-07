<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class MakeRoomDetailsFieldsNullableInRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Make number, floor_number, and size nullable since they're now stored in room_details array
            if (Schema::hasColumn('rooms', 'number')) {
                // For MySQL/MariaDB
                DB::statement('ALTER TABLE `rooms` MODIFY COLUMN `number` VARCHAR(255) NULL');
            }
            
            if (Schema::hasColumn('rooms', 'floor_number')) {
                // Check if it's integer or text type
                $columnType = DB::select("SHOW COLUMNS FROM `rooms` WHERE Field = 'floor_number'");
                if (!empty($columnType)) {
                    $type = $columnType[0]->Type;
                    if (strpos($type, 'int') !== false) {
                        DB::statement('ALTER TABLE `rooms` MODIFY COLUMN `floor_number` INT(11) NULL');
                    } else {
                        DB::statement('ALTER TABLE `rooms` MODIFY COLUMN `floor_number` TEXT NULL');
                    }
                }
            }
            
            if (Schema::hasColumn('rooms', 'size')) {
                // For MySQL/MariaDB
                DB::statement('ALTER TABLE `rooms` MODIFY COLUMN `size` INT(11) NULL');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Revert to non-nullable (if needed)
            if (Schema::hasColumn('rooms', 'number')) {
                DB::statement('ALTER TABLE `rooms` MODIFY COLUMN `number` VARCHAR(255) NOT NULL');
            }
            
            if (Schema::hasColumn('rooms', 'floor_number')) {
                $columnType = DB::select("SHOW COLUMNS FROM `rooms` WHERE Field = 'floor_number'");
                if (!empty($columnType)) {
                    $type = $columnType[0]->Type;
                    if (strpos($type, 'int') !== false) {
                        DB::statement('ALTER TABLE `rooms` MODIFY COLUMN `floor_number` INT(11) NOT NULL');
                    } else {
                        DB::statement('ALTER TABLE `rooms` MODIFY COLUMN `floor_number` TEXT NOT NULL');
                    }
                }
            }
            
            if (Schema::hasColumn('rooms', 'size')) {
                DB::statement('ALTER TABLE `rooms` MODIFY COLUMN `size` INT(11) NOT NULL');
            }
        });
    }
}
