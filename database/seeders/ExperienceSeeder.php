<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Seed the application's database with experiences.
     */
    public function run(): void
    {
        $user = User::where('email', 'sam.gar@test.com')->first();

        /* Loop experiences */

        $new_experience_data = [
            ['name' => "Soins du visage", 'type' => "Séjours bien-êtres"],
            ['name' => "A la Française", 'type' => "Gastronomie locale"],
            ['name' => "Viva L'Italie", 'type' => "Gastronomie locale"],
            ['name' => "Parapente", 'type' => "Aventures"],
            ['name' => "Baptême hélicoptère", 'type' => "Aventures"],
            ['name' => "Massage détente", 'type' => "Séjours bien-êtres"],
            ['name' => "Gastronomie mexicaine", 'type' => "Gastronomie locale"],
            ['name' => "Sortie en quad", 'type' => "Aventures"],
            ['name' => "Thalasso", 'type' => "Séjours bien-êtres"],
        ];

        for($i = 0; $i < sizeof($new_experience_data); $i++) {
            Experience::factory()->create([
                'name' => $new_experience_data[$i]['name'],
                'type' => $new_experience_data[$i]['type'],
                'location' => "Vendée",
                'address' => "...",
                'max_number_persons' => random_int(1, 8),
                'service_duration' => "1:30:00",
                'latitude' => 48.85904100017451,
                'longitude' => 2.337252575180253,
                'price' => random_int(30, 150),
                'additional_information' => "Règles supplémentaires de l'expérience",
                'image_path' => "images/seeder-images/experience-image-" . ($i + 1) . ".jpg",
                'user_id' => $user->id,
            ]);
        }
    }
}
