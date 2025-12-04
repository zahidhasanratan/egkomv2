<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixRoomsJsonColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // First, fix the double-encoded JSON data
        $rooms = \DB::table('rooms')->get();
        
        foreach ($rooms as $room) {
            $updates = [];
            
            // Fix appliances
            if ($room->appliances && is_string($room->appliances)) {
                $decoded = json_decode($room->appliances, true);
                if (is_array($decoded)) {
                    $updates['appliances'] = json_encode($decoded);
                }
            }
            
            // Fix furniture
            if ($room->furniture && is_string($room->furniture)) {
                $decoded = json_decode($room->furniture, true);
                if (is_array($decoded)) {
                    $updates['furniture'] = json_encode($decoded);
                }
            }
            
            // Fix amenities
            if ($room->amenities && is_string($room->amenities)) {
                $decoded = json_decode($room->amenities, true);
                if (is_array($decoded)) {
                    $updates['amenities'] = json_encode($decoded);
                }
            }
            
            // Fix cancellation_policy (might be string or already json)
            if ($room->cancellation_policy && is_string($room->cancellation_policy)) {
                $decoded = json_decode($room->cancellation_policy, true);
                if (is_array($decoded)) {
                    $updates['cancellation_policy'] = json_encode($decoded);
                }
            }
            
            // Update the room if there are any changes
            if (!empty($updates)) {
                \DB::table('rooms')->where('id', $room->id)->update($updates);
            }
        }
        
        // Then, change cancellation_policy column type to json
        Schema::table('rooms', function (Blueprint $table) {
            $table->json('cancellation_policy')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert cancellation_policy column type to string
        Schema::table('rooms', function (Blueprint $table) {
            $table->string('cancellation_policy')->nullable()->change();
        });
    }
}
