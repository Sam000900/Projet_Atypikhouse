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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->string('name');
            $table->string('type');
            $table->text('additional_information');
            $table->string('image_path');

            $table->string('location');
            $table->string('address');

            $table->integer('max_number_persons');
            $table->time('service_duration');
            $table->decimal('price', places: 2);

            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
