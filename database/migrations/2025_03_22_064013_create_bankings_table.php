<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bankings', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->string('payment_method')->nullable(); // Bank or Mobile Banking
            $table->string('account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('routing_number')->nullable();
            $table->string('account_type')->nullable();
            $table->string('bank_cheque_image')->nullable();
            $table->string('bakshe_number')->nullable();
            $table->string('nagad_number')->nullable();
            $table->string('dutch_bangla_number')->nullable();
            $table->string('status')->default('draft'); // submitted or draft
            $table->timestamps();


        });
    }

    public function down()
    {
        Schema::dropIfExists('bankings');
    }
}
