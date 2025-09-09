<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        Contact::factory()->create([
            'email' => "kev.tes@test.com",
            'firstname' => "Kevin",
            'lastname' => "Testher",
            'phone' => "0111111111",
            'message' => "Bonjour, je souhaiterais savoir quels types de logements il est possible de mettre en location sur votre plateforme. Pouvez-vous m'apporter quelques précisions à ce sujet ?",
        ]);
    }
}
