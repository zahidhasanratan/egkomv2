<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToPopularDestinationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('popular_destinations', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable()->after('name');
        });
        
        // Generate slugs for existing records
        $destinations = \App\Models\PopularDestination::all();
        foreach ($destinations as $destination) {
            $destination->slug = \Illuminate\Support\Str::slug($destination->name);
            $destination->save();
        }
        
        // Make slug required after populating
        Schema::table('popular_destinations', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('popular_destinations', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
