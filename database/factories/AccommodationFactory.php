<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AccommodationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->text(),
            'type' => fake()->text(),
            'area' => 1,
            'capacity' => 1,
            'bedrooms' => 1,
            'department' => fake()->text(),
            'municipality' => fake()->text(),
            'address' => fake()->text(),
            'description' => fake()->paragraph(),
            'latitude' => 1,
            'longitude' => 1,
            'main_image' => fake()->text(),
            'wifi' => fake()->boolean(),
            'air_conditioning' => fake()->boolean(),
            'parking' => fake()->boolean(),
            'spa' => fake()->boolean(),
            'equipped_kitchen' => fake()->boolean(),
            'household_linen_provided' => fake()->boolean(),
            'bathroom' => fake()->boolean(),
            'price_night' => 1,
            'min_number_nights' => 1,
            'security_deposit' => 1,
            'cleaning_charges' => 1,
            'arrival_time' => "10:00:00",
            'departure_time' => "10:00:00",
            'smokers_allowed' => fake()->boolean(),
            'pets_allowed' => fake()->boolean(),
            'events_allowed' => fake()->boolean(),
            'minimum_age' => 1,
            'additional_rules' => fake()->text(),
            'user_id' => 1,
        ];
    }
}
