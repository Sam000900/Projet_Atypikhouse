<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->integer('area');
            $table->integer('capacity');
            $table->integer('bedrooms');
            $table->string('department');
            $table->string('municipality');
            $table->string('address');
            $table->text('description');
            $table->float('latitude');
            $table->float('longitude');
            $table->string('main_image');
            $table->boolean('wifi');
            $table->boolean('air_conditioning');
            $table->boolean('parking');
            $table->boolean('spa');
            $table->boolean('equipped_kitchen');
            $table->boolean('household_linen_provided');
            $table->boolean('bathroom');
            $table->decimal('price_night', places: 2);
            $table->integer('min_number_nights');
            $table->decimal('security_deposit', places: 2);
            $table->decimal('cleaning_charges', places: 2);
            $table->time('arrival_time');
            $table->time('departure_time');
            $table->boolean('smokers_allowed');
            $table->boolean('pets_allowed');
            $table->boolean('events_allowed');
            $table->integer('minimum_age');
            $table->text('additional_rules');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};
