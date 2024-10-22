<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('property_name');
            $table->text('property_description')->nullable();
            $table->string('property_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('property_management_address')->nullable();
            $table->string('property_management_city')->nullable();
            $table->string('property_management_state')->nullable();
            $table->string('property_management_zipcode')->nullable();
            $table->string('property_type')->nullable(); // 'bed' or other types
            $table->integer('number_of_beds')->nullable();
            $table->decimal('rent_bed', 10, 2)->nullable(); // Assuming rent is a decimal
            $table->decimal('bed_deposit', 10, 2)->nullable();
            $table->decimal('bed_fee', 10, 2)->nullable();
            $table->integer('number_of_bedrooms')->nullable();
            $table->decimal('stay_one_bedroom')->nullable();
            $table->decimal('bedroom_deposit', 10, 2)->nullable();
            $table->decimal('bedroom_fee', 10, 2)->nullable();
            $table->integer('number_of_bedrooms_house')->nullable();
            $table->integer('number_of_bath_house')->nullable();
            $table->decimal('rent_unit', 10, 2)->nullable();
            $table->decimal('unit_deposit', 10, 2)->nullable();
            $table->decimal('unit_fee', 10, 2)->nullable();
            $table->boolean('is_property_occupied')->default(false);
            $table->string('main_picture')->nullable(); // Store the path for the main picture
            $table->text('more_pictures')->nullable(); // Store additional picture paths as JSON or text
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
};
