<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('homepage_hero_settings', function (Blueprint $table) {
            $table->id();
            $table->string('video_path')->nullable()->comment('Path to video file (e.g. uploads/homepage_hero/xxx.mp4 or frontend/images/slider/hero-bg-cover.mp4)');
            $table->string('title')->default('Welcome to Eg Kom!');
            $table->string('subtitle')->default('Find Hotels, Visa & Holidays');
            $table->timestamps();
        });

        // Insert default row so we always have one record
        DB::table('homepage_hero_settings')->insert([
            'video_path' => 'frontend/images/slider/hero-bg-cover.mp4',
            'title' => 'Welcome to Eg Kom!',
            'subtitle' => 'Find Hotels, Visa & Holidays',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homepage_hero_settings');
    }
};
