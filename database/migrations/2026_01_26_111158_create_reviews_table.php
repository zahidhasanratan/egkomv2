<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained('hotels')->onDelete('cascade');
            $table->foreignId('guest_id')->nullable()->constrained('guests')->onDelete('set null');
            $table->foreignId('booking_id')->nullable()->constrained('bookings')->onDelete('set null');
            
            // Overall rating and title
            $table->decimal('overall_rating', 3, 1)->default(0); // 0.0 to 10.0
            $table->string('title')->nullable();
            $table->text('comment')->nullable();
            
            // Category ratings (0-10 scale)
            $table->decimal('staff_rating', 3, 1)->nullable();
            $table->decimal('facilities_rating', 3, 1)->nullable();
            $table->decimal('cleanliness_rating', 3, 1)->nullable();
            $table->decimal('location_rating', 3, 1)->nullable();
            $table->decimal('comfort_rating', 3, 1)->nullable();
            $table->decimal('value_for_money_rating', 3, 1)->nullable();
            $table->decimal('free_wifi_rating', 3, 1)->nullable();
            
            // Pros and cons
            $table->text('pros')->nullable();
            $table->text('cons')->nullable();
            
            // Review images
            $table->json('images')->nullable();
            
            // Status
            $table->boolean('is_approved')->default(false);
            $table->boolean('is_featured')->default(false);
            
            // Hotel response
            $table->text('hotel_response')->nullable();
            $table->timestamp('hotel_response_date')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
