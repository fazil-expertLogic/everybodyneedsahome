<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasePlanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_plan', function (Blueprint $table) {
            
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('membership_id'); // Foreign key reference to membership
            $table->timestamp('purchase_date')->nullable();
            $table->string('stripeToken'); // Store the Stripe token
            $table->string('last4', 4); // Last 4 digits of the card
            $table->integer('exp_month'); // Expiration month of the card
            $table->integer('exp_year'); // Expiration year of the card
            $table->timestamps(); // Created at and updated at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_plan');
    }
}
