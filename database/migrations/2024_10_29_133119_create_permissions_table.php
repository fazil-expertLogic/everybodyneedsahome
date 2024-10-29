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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id'); // Links to roles table
            $table->foreignId('menu_id'); // Links to menus table
            $table->boolean('is_listing')->default(0);
            $table->boolean('is_show')->default(0);
            $table->boolean('is_create')->default(0);
            $table->boolean('is_edit')->default(0);
            $table->boolean('is_delete')->default(0);
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
        Schema::dropIfExists('permissions');
    }
};
