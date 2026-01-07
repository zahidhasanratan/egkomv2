<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMealNoteFieldsToRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Meal Options note fields
            $table->text('meal_complementary_note')->nullable()->after('pet_paid_note');
            $table->text('meal_paid_note')->nullable()->after('meal_complementary_note');
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
            $table->dropColumn([
                'meal_complementary_note',
                'meal_paid_note',
            ]);
        });
    }
}
