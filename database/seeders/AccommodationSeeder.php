<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Accommodation;
use App\Models\AccommodationImage;
use Illuminate\Database\Seeder;

class AccommodationSeeder extends Seeder
{
    /**
     * Seed the application's database with accommodations bind to differents users.
     */
    public function run(): void
    {
        $user_0 = User::where('email', 'sam.gar@test.com')->first();
        $user_1 = User::where('email', 'kev.tes@test.com')->first();
        $user_2 = User::where('email', 'lis.pal@test.com')->first();
        $user_3 = User::where('email', 'eli.mor@test.com')->first();
        $user_4 = User::where('email', 'joh.alm@test.com')->first();
        $user_5 = User::where('email', 'jus.art@test.com')->first();

        /* Loop accommodations */

        $new_accommodation_data = [
            ['type' => "Cabane", 'user_id' => $user_3->id],
            ['type' => "Péniche", 'user_id' => $user_2->id],
            ['type' => "Maison", 'user_id' => $user_2->id],
            ['type' => "Cabane", 'user_id' => $user_4->id],
            ['type' => "Maison", 'user_id' => $user_4->id],
            ['type' => "Bulle", 'user_id' => $user_3->id],
            ['type' => "Yourte", 'user_id' => $user_5->id],
            ['type' => "Bulle", 'user_id' => $user_5->id],
            ['type' => "Cabane", 'user_id' => $user_3->id],
            ['type' => "Maison", 'user_id' => $user_2->id],
            ['type' => "Maison", 'user_id' => $user_4->id],
            ['type' => "Yourte", 'user_id' => $user_4->id],
            ['type' => "Maison", 'user_id' => $user_3->id],
            ['type' => "Péniche", 'user_id' => $user_4->id],
            ['type' => "Péniche", 'user_id' => $user_2->id],
            ['type' => "Bulle", 'user_id' => $user_5->id],
            ['type' => "Bulle", 'user_id' => $user_1->id],
            ['type' => "Yourte", 'user_id' => $user_5->id],
            ['type' => "Cabane", 'user_id' => $user_4->id],
        ];

        for($i = 0; $i < sizeof($new_accommodation_data); $i++) {
            $new_accommodation = Accommodation::factory()->create([
                'name' => "Logement " . ($i),
                'type' => $new_accommodation_data[$i]['type'],
                'area' => random_int(30, 150),
                'capacity' => random_int(1, 12),
                'bedrooms' => random_int(1, 6),
                'department' => "Vendée",
                'municipality' => "Clécy",
                'address' => "...",
                'description' => "...",
                'latitude' => 48.85904100017451,
                'longitude' => 2.337252575180253,
                'main_image' => "images/seeder-images/accommodation-" . ($i + 1) . "-image-1.jpg",
                'wifi' => (bool)random_int(0, 1),
                'air_conditioning' =>  (bool)random_int(0, 1),
                'parking' =>  (bool)random_int(0, 1),
                'spa' =>  (bool)random_int(0, 1),
                'equipped_kitchen' =>  (bool)random_int(0, 1),
                'household_linen_provided' =>  (bool)random_int(0, 1),
                'bathroom' =>  (bool)random_int(0, 1),
                'price_night' => random_int(80, 300),
                'min_number_nights' => random_int(1, 5),
                'security_deposit' => random_int(200, 600),
                'cleaning_charges' => random_int(20, 100),
                'arrival_time' => "10:30:00",
                'departure_time' => "8:30:00",
                'smokers_allowed' =>  (bool)random_int(0, 1),
                'pets_allowed' =>  (bool)random_int(0, 1),
                'events_allowed' =>  (bool)random_int(0, 1),
                'minimum_age' =>  random_int(15, 18),
                'additional_rules' => "Règles supplémentaires du logement",
                'user_id' => $new_accommodation_data[$i]['user_id'],
            ]);

            AccommodationImage::factory()->create([
                'accommodation_id' => $new_accommodation->id,
                'image_path' => "images/seeder-images/accommodation-" . ($i + 1) . "-image-1.jpg",
                'is_main' => true,
            ]);
        }

        /* Accommodation 20 */

        $accommodation_20 = Accommodation::factory()->create([
            'name' => "Maison avec vue panoramique et jacuzzi privé",
            'type' => "Maison",
            'area' => 166,
            'capacity' => 12,
            'bedrooms' => 6,
            'department' => "Landes",
            'municipality' => "Luxey",
            'address' => "Chem. de la Plage, 40200 Aureilhan",
            'description' => "Évadez-vous dans ce havre de paix en bord de mer, où le son des vagues et la brise marine vous invitent à la détente. Profitez d'une terrasse privée avec vue panoramique, d'un intérieur cosy baigné de lumière et d'un cadre idyllique pour un séjour inoubliable. Réservez votre escapade dès maintenant !",
            'latitude' => 44.2251353906258,
            'longitude' => -1.194156327381768,
            'main_image' => "images/seeder-images/accommodation-20-image-1.jpg",
            'wifi' => true,
            'air_conditioning' => true,
            'parking' => true,
            'spa' => true,
            'equipped_kitchen' => true,
            'household_linen_provided' => true,
            'bathroom' => true,
            'price_night' => 243,
            'min_number_nights' => 3,
            'security_deposit' => 470,
            'cleaning_charges' => 65.35,
            'arrival_time' => "17:00:00",
            'departure_time' => "10:00:00",
            'smokers_allowed' => false,
            'pets_allowed' => false,
            'events_allowed' => false,
            'minimum_age' => 18,
            'additional_rules' => "Règles supplémentaires du logement",
            'user_id' => $user_0->id,
        ]);

        AccommodationImage::factory()->create([
            'accommodation_id' => $accommodation_20->id,
            'image_path' => "images/seeder-images/accommodation-20-image-1.jpg",
            'is_main' => true,
        ]);

        AccommodationImage::factory()->create([
            'accommodation_id' => $accommodation_20->id,
            'image_path' => "images/seeder-images/accommodation-20-image-2.jpg",
            'is_main' => false,
        ]);

        AccommodationImage::factory()->create([
            'accommodation_id' => $accommodation_20->id,
            'image_path' => "images/seeder-images/accommodation-20-image-3.jpg",
            'is_main' => false,
        ]);

        AccommodationImage::factory()->create([
            'accommodation_id' => $accommodation_20->id,
            'image_path' => "images/seeder-images/accommodation-20-image-4.jpg",
            'is_main' => false,
        ]);

        AccommodationImage::factory()->create([
            'accommodation_id' => $accommodation_20->id,
            'image_path' => "images/seeder-images/accommodation-20-image-5.jpg",
            'is_main' => false,
        ]);

        AccommodationImage::factory()->create([
            'accommodation_id' => $accommodation_20->id,
            'image_path' => "images/seeder-images/accommodation-20-image-6.jpg",
            'is_main' => false,
        ]);

        /* Accommodation 21 */

        $accommodation_21 = Accommodation::factory()->create([
            'name' => "Bulle en haut d'une colline dans les bois",
            'type' => "Bulle",
            'area' => 25,
            'capacity' => 1,
            'bedrooms' => 1,
            'department' => "Lot",
            'municipality' => "Bach",
            'address' => "...",
            'description' => "...",
            'latitude' => 44.350982469027194,
            'longitude' => -1.668562943268097,
            'main_image' => "images/seeder-images/accommodation-21-image-1.jpg",
            'wifi' => false,
            'air_conditioning' => false,
            'parking' => false,
            'spa' => false,
            'equipped_kitchen' => true,
            'household_linen_provided' => false,
            'bathroom' => false,
            'price_night' => 120.99,
            'min_number_nights' => 1,
            'security_deposit' => 262,
            'cleaning_charges' => 18.60,
            'arrival_time' => "12:00:00",
            'departure_time' => "9:30:00",
            'smokers_allowed' => false,
            'pets_allowed' => true,
            'events_allowed' => true,
            'minimum_age' => 16,
            'additional_rules' => "Règles supplémentaires du logement",
            'user_id' => $user_1->id,
        ]);

        AccommodationImage::factory()->create([
            'accommodation_id' => $accommodation_21->id,
            'image_path' => "images/seeder-images/accommodation-21-image-1.jpg",
            'is_main' => true,
        ]);

        /* Accommodation 22 */

        $accommodation_22 = Accommodation::factory()->create([
            'name' => "Péniche floral sur la seine",
            'type' => "péniche",
            'area' => 80,
            'capacity' => 4,
            'bedrooms' => 2,
            'department' => "Paris",
            'municipality' => "Paris",
            'address' => "...",
            'description' => "...",
            'latitude' => 48.85904100017451,
            'longitude' => 2.337252575180253,
            'main_image' => "images/seeder-images/accommodation-22-image-1.jpg",
            'wifi' => true,
            'air_conditioning' => false,
            'parking' => false,
            'spa' => false,
            'equipped_kitchen' => true,
            'household_linen_provided' => true,
            'bathroom' => true,
            'price_night' => 225,
            'min_number_nights' => 3,
            'security_deposit' => 632.50,
            'cleaning_charges' => 40.75,
            'arrival_time' => "10:30:00",
            'departure_time' => "8:45:00",
            'smokers_allowed' => true,
            'pets_allowed' => true,
            'events_allowed' => false,
            'minimum_age' => 18,
            'additional_rules' => "Règles supplémentaires du logement",
            'user_id' => $user_1->id,
        ]);

        AccommodationImage::factory()->create([
            'accommodation_id' => $accommodation_22->id,
            'image_path' => "images/seeder-images/accommodation-22-image-1.jpg",
            'is_main' => true,
        ]);
    }
}
