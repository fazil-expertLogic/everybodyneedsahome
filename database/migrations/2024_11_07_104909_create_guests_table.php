<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->string('ssn')->unique();
            $table->date('dob');
            
            // Address Fields
            $table->string('address');
            $table->string('address2')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('zip');

            // Contact Information
            $table->string('phone');
            $table->string('email')->unique();

            // Eviction Information
            $table->boolean('evicted')->default(false);
            $table->string('eviction_property_name')->nullable();
            $table->string('eviction_manager_name')->nullable();
            $table->string('eviction_address')->nullable();
            $table->string('eviction_phone')->nullable();
            $table->date('eviction_date')->nullable();
            $table->text('eviction_comments')->nullable();

            // Criminal History
            $table->boolean('convicted')->default(false);
            $table->string('conviction_year')->nullable();
            $table->string('conviction_charge')->nullable();
            $table->string('conviction_sentence')->nullable();
            $table->boolean('sex_offender')->default(false);
            $table->boolean('victim_minor')->nullable();
            $table->integer('age_difference')->nullable();
            $table->boolean('probation')->default(false);
            $table->string('probation_officer_name')->nullable();
            $table->string('probation_officer_phone')->nullable();
            $table->string('probation_officer_email')->nullable();

            // References
            $table->string('ref1_name')->nullable();
            $table->string('ref1_phone')->nullable();
            $table->string('ref1_email')->nullable();
            $table->string('ref2_name')->nullable();
            $table->string('ref2_phone')->nullable();
            $table->string('ref2_email')->nullable();
            $table->string('ref3_name')->nullable();
            $table->string('ref3_phone')->nullable();
            $table->string('ref3_email')->nullable();

            // Emergency Contact
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
            $table->string('emergency_contact_email');

            // Employment and Financial Information
            $table->string('employer_name')->nullable();
            $table->string('employer_phone')->nullable();
            $table->decimal('income', 10, 2)->nullable();
            $table->decimal('expenses', 10, 2)->nullable();
            $table->decimal('rental_budget', 10, 2)->nullable();
            $table->boolean('status')->default(1);

            // Timestamps
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
        Schema::dropIfExists('guests');
    }
}
