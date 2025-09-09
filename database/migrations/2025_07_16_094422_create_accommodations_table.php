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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->string('main_image');
            $table->string('name');
            $table->string('type');
            $table->unsignedInteger('area');
            $table->unsignedInteger('capacity');
            $table->unsignedInteger('bedrooms');
            $table->text('description');
            $table->text('additional_rules');

            $table->string('department');
            $table->string('municipality');
            $table->string('address');

            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);

            $table->boolean('wifi')->default(true);
            $table->boolean('air_conditioning')->default(false);
            $table->boolean('parking')->default(false);
            $table->boolean('spa')->default(false);
            $table->boolean('equipped_kitchen')->default(false);
            $table->boolean('household_linen_provided')->default(false);
            $table->boolean('bathroom')->default(true);
            $table->boolean('smokers_allowed')->default(false);
            $table->boolean('pets_allowed')->default(false);
            $table->boolean('events_allowed')->default(false);

            $table->decimal('price_night', places: 2);
            $table->unsignedInteger('min_number_nights');
            $table->decimal('security_deposit', places: 2);
            $table->decimal('cleaning_charges', places: 2);
            
            $table->time('arrival_time');
            $table->time('departure_time');

            $table->unsignedInteger('minimum_age');
            
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
