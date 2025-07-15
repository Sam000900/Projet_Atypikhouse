<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExperienceFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

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
            'location' => fake()->text(),
            'address' => fake()->text(),
            'max_number_persons' => 1,
            'service_duration' => 1,
            'latitude' => 1,
            'longitude' => 1,
            'price' => 1,
            'additional_information' => fake()->text(),
            'image_path' => fake()->text(),
            'user_id' => 1,
        ];
    }
}